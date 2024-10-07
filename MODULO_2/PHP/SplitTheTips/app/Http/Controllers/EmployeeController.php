<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Invitation;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeInvitation;
use App\Notifications\WelcomeNotification;
use App\Models\WorkShift;
use App\Models\Tip;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\TipDistribution;
use App\Models\Shift;


class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Aplica solo a rutas específicas que deberían ser accedidas por una empresa
        $this->middleware('checkRole:company')->only(['index', 'create', 'store', 'edit', 'update', 'destroy', 'inviteForm', 'sendInvite']);
        // Si necesitas aplicar algo similar para empleados, puedes agregar:
        $this->middleware('checkRole:employee')->only(['dashboard', 'myTips', 'acceptInvitation', 'rejectInvitation']);
    }
    

    public function index()
    {
        
        $user = Auth::user();
        if (!$user->company) {
            return redirect()->route('company.dashboard')->with('error', 'No tienes una empresa asociada.');
        }

        
        $employees = Employee::where('company_id', $user->company->id)->with('user', 'area')->get();
        return view('company.employees.index', compact('employees'));
    }

    public function create()
    {
        $areas = Auth::user()->company->areas;
        return view('company.employees.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->company) {
            return redirect()->route('company.dashboard')->with('error', 'No tienes una empresa asociada.');
        }

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'area_id' => 'required|exists:areas,id',
        ]);

        $employee = Employee::create($validatedData);
        return redirect()->route('company.employees.index')->with('success', 'Employee created successfully');
    }

    public function edit(Employee $employee)
    {
        $this->authorize('update', $employee);
        $areas = Auth::user()->company->areas;
        return view('company.employees.edit', compact('employee', 'areas'));
    }

    public function update(Request $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $validatedData = $request->validate([
            'area_id' => 'required|exists:areas,id',
        ]);

        $employee->update($validatedData);
        return redirect()->route('company.employees.index')->with('success', 'Employee updated successfully');
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete', $employee);

        $employee->delete();
        return redirect()->route('company.employees.index')->with('success', 'Employee deleted successfully');
    }

    public function inviteForm()
    {
        $areas = Auth::user()->company->areas;
        return view('company.employees.invite', compact('areas'));
    }

    public function sendInvite(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email'
        ]);

        $company = Auth::user()->company;

        $invitation = new Invitation([
            'email' => $request->email,
            'token' => Str::random(32),
            'company_id' => $company->id,
        ]);

        if ($invitation->save()) {
            // Enviar el email de invitación
            Mail::to($request->email)->send(new EmployeeInvitation($invitation));

            return redirect()->back()->with('success', 'Invitación enviada con éxito.');
        } else {
            return redirect()->back()->with('error', 'No se pudo enviar la invitación. Por favor, inténtalo de nuevo.');
        }
    }

    public function acceptInvitation(Invitation $invitation)
    {
        if ($invitation->email !== Auth::user()->email) {
            return response()->json(['error' => 'Invitación no válida.'], 400);
        }
    
        $invitation->update(['status' => 'accepted']);
        Employee::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'company_id' => $invitation->company_id,
                'area_id' => $invitation->area_id
            ]
        );

        session()->forget('pending_invitation');
    
        return redirect()->route('employee.dashboard')->with('success', 'Invitación aceptada correctamente.');
    }
    
    public function rejectInvitation(Invitation $invitation)
    {
        if ($invitation->email !== Auth::user()->email) {
            return redirect()->back()->with('error', 'Invitación no válida.');
        }
    
        $invitation->update(['status' => 'rejected']);

        session()->forget('pending_invitation');
    
        return redirect()->route('employee.dashboard')->with('success', 'Invitación rechazada.');
    }

    public function registerInvitedEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'invitation_token' => 'required|exists:invitations,token',
        ]);
    
        $invitation = Invitation::where('token', $request->invitation_token)->firstOrFail();
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'employee',
        ]);
    
        $user->notify(new WelcomeNotification());

        Employee::create([
            'user_id' => $user->id,
            'company_id' => $invitation->company_id,
        ]);
    
        $invitation->delete();
    
        // Enviar notificación de bienvenida
        $user->notify(new WelcomeNotification());
    
        // Iniciar sesión automáticamente
        Auth::login($user);
    
        return redirect()->route('employee.dashboard')->with('success', 'Registro completado con éxito.');
    }
    public function showShifts()
    {
    $employee = Auth::user()->employee;
    $shifts = $employee->workShifts()->orderBy('date')->get();
    return view('employee.shifts', compact('shifts'));
    }
    public function dashboard()
    {
        $user = Auth::user();
        $employee = $user->employee;
    
        if (!$employee) {
            return redirect()->route('home')->with('error', 'No se encontró información de empleado.');
        }
    
        $currentArea = $employee->area;
        $pendingInvitations = Invitation::where('email', Auth::user()->email)
        ->where('status', 'pending')
        ->with('company', 'area')
        ->get();
    
        $tips = Tip::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        $upcomingShifts = WorkShift::where('employee_id', $employee->id)
        ->where('date', '>=', now()) // Ajusta según tu lógica
        ->orderBy('date')
        ->with('area')
        ->get();
    
        return view('employee.dashboard', compact('currentArea', 'upcomingShifts', 'employee', 'tips', 'pendingInvitations'));
    }

    public function tips()
    {
        $employee = Auth::user()->employee;
        
        $tips = Tip::where('employee_id', $employee->id)
                   ->with('area')  // Carga eager de la relación 'area'
                   ->orderBy('created_at', 'desc')
                   ->paginate(15);  // Ajusta el número según tus necesidades

        // Cálculos para el resumen
        $totalTips = $tips->sum('amount');
        $averageTip = $tips->avg('amount');

        return view('employee.tips', compact('tips', 'totalTips', 'averageTip'));
    }

    public function myTips()
    {
        $employee = Auth::user()->employee;
    
        if (!$employee) {
            return redirect()->route('home')->with('error', 'No se encontró información de empleado.');
        }
    
        $allTips = Tip::where('employee_id', $employee->id)
            ->with('area')
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Paginación
        $perPage = 15;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $currentPageItems = $allTips->slice(($currentPage - 1) * $perPage, $perPage);
    
        $tips = new LengthAwarePaginator(
            $currentPageItems,
            $allTips->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );
    
        return view('employee.my-tips', compact('tips'));
    }
    public function showMyTips()
    {
        $user = Auth::user();
        $employee = $user->employee;
    
        if (!$employee) {
            return redirect()->route('home')->with('error', 'No se encontró información de empleado.');
        }
    
        $tips = Tip::where('employee_id', $employee->id)
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('employee.my-tips', compact('tips'));
    }

    public function profile()
    {
        $user = Auth::user();
        $employee = $user->employee;

        return view('profile.show', compact('user', 'employee'));
    }
}