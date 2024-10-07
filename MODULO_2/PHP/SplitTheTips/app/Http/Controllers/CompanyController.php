<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Area;
use App\Models\Tip;
use App\Models\Invitation;
use App\Models\User;
use App\Models\WorkShift;
use App\Models\TipPool;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TipDistribution;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        return view('company.index', compact('company'));
    }

    public function update(Request $request)
    {
        $company = Auth::user()->company;
        $company->update($request->validate([
            'company_name' => 'required|string|max:255',
        ]));
        return redirect()->route('company.index')->with('success', 'Company updated successfully');
    }
    public function show(Company $company)
    {
    if (!$company) {
        return redirect()->route('home')->with('error', 'Compañía no encontrada.');
    }

    $areas = $company->areas ?? collect();
    $employees = $company->employees ?? collect();
    return view('company.show', compact('company', 'areas', 'employees'));
    }
    public function profile()
    {
    $company = Auth::user()->company;
    return view('company.profile', compact('company'));
    }

    public function dashboard()
    {
        $company = Auth::user()->company;
    
        $employees = Employee::where('company_id', Auth::user()->company_id)->get();
        $workShifts = WorkShift::where('company_id', Auth::user()->company_id)
            ->orderBy('date', 'desc')
            ->paginate(10);
    
        $employeeCount = $company->employees()->count();
        $areaCount = $company->areas()->count();
    
        // Obtener el último TipPool distribuido
        $latestTipPool = TipPool::latest()->first(); // Último TipPool creado

        // Calcular el total de propinas distribuidas solo del último TipPool distribuido
        $recentTipsTotal = $latestTipPool ? TipDistribution::where('tip_pool_id', $latestTipPool->id)->sum('amount') : 0;
    
        // Calcular el total de propinas de los empleados solo del último TipPool distribuido
        $employeeTipTotals = [];
        if ($latestTipPool) {
            // Obtener la distribución de propinas del último fondo
            foreach ($employees as $employee) {
                $tipDistribution = TipDistribution::where('employee_id', $employee->id)
                                    ->where('tip_pool_id', $latestTipPool->id) // Solo la distribución del último fondo
                                    ->sum('amount');
    
                $employeeTipTotals[$employee->id] = $tipDistribution;
            }
        }
    
        // Obtener el TipPool actual pendiente
        $currentTipPool = TipPool::where('company_id', $company->id)
            ->where('status', 'pending')
            ->orderBy('date', 'desc')
            ->first();
    
        // Obtener empleados con sus propinas distribuidas en el fondo de propinas actual
        $topEmployees = Employee::where('company_id', $company->id)
            ->withSum(['tipDistributions' => function ($query) use ($currentTipPool) {
                if ($currentTipPool) {
                    $query->where('tip_pool_id', $currentTipPool->id);
                }
            }], 'amount')
            ->orderByDesc('tip_distributions_sum_amount')
            ->take(5)
            ->get();
    
        // Obtener áreas con sus propinas distribuidas en el fondo de propinas actual
        $topAreas = Area::where('company_id', $company->id)
            ->withSum(['tipDistributions' => function ($query) use ($currentTipPool) {
                if ($currentTipPool) {
                    $query->where('tip_pool_id', $currentTipPool->id);
                }
            }], 'amount')
            ->orderByDesc('tip_distributions_sum_amount')
            ->take(5)
            ->get();
    
        return view('company.dashboard', compact(
            'employees',
            'employeeCount',
            'areaCount',
            'recentTipsTotal', // Ahora refleja el total de propinas distribuidas
            'workShifts',
            'topEmployees',
            'topAreas',
            'employeeTipTotals'
        ));
    }
    
    public function calculateTips()
    {
        $company = Auth::user()->company;
        $employees = $company->employees;
        
        return view('company.calculate-tips', compact('employees'));
    }

    public function calculateTipsPost(Request $request)
    {
        $request->validate([
            'total_tips' => 'required|numeric|min:0', // Total de propinas a distribuir
        ]);
    
        $company = Auth::user()->company;
        $totalTips = $request->input('total_tips');
    
        // Obtener todas las áreas de la compañía y sus porcentajes de propinas
        $areas = $company->areas;
    
        // Inicializamos una variable para el total de horas por área
        $hoursByArea = [];
    
        // Inicializamos una variable para las propinas asignadas a cada empleado
        $tipsByEmployee = [];
    
        // Recorrer todas las áreas para calcular las horas totales trabajadas
        foreach ($areas as $area) {
            $employeesInArea = $area->employees;
    
            // Obtener las horas trabajadas por cada empleado en el área
            foreach ($employeesInArea as $employee) {
                // Sumar todas las horas trabajadas desde la última distribución de propinas
                $hoursWorked = WorkShift::where('employee_id', $employee->id)
                    ->where('date', '>=', $this->getLastTipDistributionDate($company->id)) // Si tienes una función que devuelve la fecha de la última distribución
                    ->sum('hours_worked');
    
                if (!isset($hoursByArea[$area->id])) {
                    $hoursByArea[$area->id] = 0;
                }
                $hoursByArea[$area->id] += $hoursWorked;
    
                // Guardamos las horas trabajadas por cada empleado para distribuir propinas más tarde
                $tipsByEmployee[$employee->id] = [
                    'hours_worked' => $hoursWorked,
                    'area_id' => $area->id,
                    'amount' => 0, // Inicializar la cantidad que recibirá
                ];
            }
        }
    
        // Ahora distribuimos las propinas basado en las horas trabajadas y el porcentaje del área
        foreach ($areas as $area) {
            $areaTipPercentage = $area->tip_percentage / 100; // Convertir el porcentaje en decimal
            $areaTips = $totalTips * $areaTipPercentage; // Propinas totales para esta área
            $totalHoursInArea = $hoursByArea[$area->id] ?? 0; // Total de horas trabajadas en esta área
    
            if ($totalHoursInArea > 0) {
                foreach ($tipsByEmployee as $employeeId => &$employeeTipData) {
                    if ($employeeTipData['area_id'] === $area->id) {
                        // Calcular la proporción de horas trabajadas por este empleado
                        $hoursWorkedByEmployee = $employeeTipData['hours_worked'];
                        $employeeTipData['amount'] = ($hoursWorkedByEmployee / $totalHoursInArea) * $areaTips;
                    }
                }
            }
        }
    
        // Guardar las propinas calculadas en la base de datos
        foreach ($tipsByEmployee as $employeeId => $employeeTipData) {
            if ($employeeTipData['amount'] > 0) {
                Tip::create([
                    'company_id' => $company->id,
                    'employee_id' => $employeeId,
                    'amount' => $employeeTipData['amount'],
                    'date' => now(),
                ]);
            }
        }
    
        return redirect()->route('company.dashboard')->with('success', 'Tips calculated and saved successfully.');
    }
    
    // Esta función puede ser usada para obtener la última fecha de distribución de propinas
    private function getLastTipDistributionDate($companyId)
    {
        $lastTipPool = TipPool::where('company_id', $companyId)
            ->where('status', 'distributed')
            ->orderBy('date', 'desc')
            ->first();
    
        return $lastTipPool ? $lastTipPool->date : null;
    }
    

    public function sendInvite(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'area_id' => 'required|exists:areas,id',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user) {
        Invitation::create([
            'company_id' => Auth::user()->company->id,
            'user_id' => $user->id,
            'area_id' => $request->area_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Invitación enviada correctamente.');
    }

    return redirect()->back()->with('error', 'Usuario no encontrado.');
    }
    public function inviteForm()
    {
        $company = Auth::user()->company;
        $areas = $company->areas;
        $users = User::where('role', 'employee')->whereDoesntHave('employee')->get();
        return view('company.invite', compact('areas', 'users'));
    }
    
    public function storeInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'area_id' => 'required|exists:areas,id',
        ]);
    
        $company = Auth::user()->company;
    
        // Verificar si ya existe una invitación pendiente
        $existingInvitation = Invitation::where('email', $request->email)
            ->where('company_id', $company->id)
            ->where('status', 'pending')
            ->first();
    
        if ($existingInvitation) {
            return redirect()->back()->with('error', 'Ya existe una invitación pendiente para este usuario.');
        }
    
        $invitation = new Invitation([
            'company_id' => $company->id,
            'area_id' => $request->area_id,
            'email' => $request->email,
            'status' => 'pending'
        ]);
    
        $invitation->save();
    
        return redirect()->route('company.dashboard')->with('success', 'Invitación creada correctamente.');
    }
    public function showTipDistribution()
    {
    $company = Auth::user()->company;
    $tipPools = TipPool::where('company_id', $company->id)
                       ->where('status', 'distributed')
                       ->with(['tipDistributions.employee', 'tipDistributions.area'])
                       ->orderBy('date', 'desc')
                       ->get();

    return view('company.tip_distribution', compact('tipPools'));
    }
    public function registerDailyTips(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);
    
        $company = Auth::user()->company;
    
        // Marcar el fondo anterior como distribuido
        $lastTipPool = TipPool::where('company_id', $company->id)
                                ->where('status', 'pending')  // Solo si el estado es pendiente
                                ->orderBy('date', 'desc')
                                ->first();
    
        if ($lastTipPool) {
            $lastTipPool->update(['status' => 'distributed']);
        }
    
        // Crear el nuevo fondo de propinas
        $tipPool = TipPool::create([
            'company_id' => $company->id,
            'date' => $validatedData['date'],
            'total_amount' => $validatedData['total_amount'],
            'status' => 'pending'  // Nuevo fondo en estado pendiente
        ]);
    
        return redirect()->route('company.calculate-tips', ['tip_pool_id' => $tipPool->id])
                         ->with('success', 'Fondo de propinas registrado correctamente. Ahora puedes calcular la distribución.');
    }
    
    public function showRegisterDailyTipsForm()
    {
        return view('company.tips.register_daily_tips');
    }
    public function storeDailyTips(Request $request)
    {
    $validatedData = $request->validate([
        'date' => 'required|date',
        'total_amount' => 'required|numeric|min:0',
    ]);

    // Create a new TipPool record
    $tipPool = TipPool::create([
        'company_id' => Auth::user()->company->id,
        'date' => $validatedData['date'],
        'total_amount' => $validatedData['total_amount'],
    ]);

    return redirect()->route('company.dashboard')
                     ->with('success', 'Daily tips registered successfully.');
    }
 
    public function monthlyReport(Request $request)
    {
    $year = $request->input('year', Carbon::now()->year);
    $month = $request->input('month', Carbon::now()->month);

    $startDate = Carbon::create($year, $month, 1)->startOfMonth();
    $endDate = $startDate->copy()->endOfMonth();

    $report = DB::table('tip_pools')
        ->select(
            DB::raw('SUM(total_amount) as total_tips'),
            DB::raw('AVG(total_amount) as average_tips'),
            DB::raw('COUNT(*) as days_with_tips')
        )
        ->whereBetween('date', [$startDate, $endDate])
        ->where('company_id', Auth::user()->company->id)
        ->first();

    // You might want to add more data to the report here, such as top employees or areas

    return view('company.report.monthly_report', [
        'report' => $report,
        'year' => $year,
        'month' => $month
    ]);
    }

}