<?php

namespace App\Http\Controllers;

use App\Models\TipPool;
use App\Models\Area;
use App\Models\Employee;
use App\Models\WorkShift;
use App\Models\TipDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TipPoolController extends Controller
{
    public function index()
    {
        $tipPools = TipPool::orderBy('date', 'desc')->get();
        return view('company.tip_pools.index', compact('tipPools'));
    }

    public function create()
    {
        return view('company.tip_pools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        TipPool::create([
            'company_id' => Auth::user()->company->id,
            'date' => $validated['date'],
            'total_amount' => $validated['total_amount'],
        ]);

        return redirect()->route('company.tip_pools.index')->with('success', 'Fondo de propinas registrado exitosamente.');
    }

    public function distribute(TipPool $tipPool)
    {
        DB::beginTransaction();
    
        try {
            $this->validateDistribution($tipPool);
            $areas = $this->getCompanyAreas();
            
            // Eliminar distribuciones anteriores para este TipPool
            TipDistribution::where('tip_pool_id', $tipPool->id)->delete();
    
            $this->distributeToAreas($tipPool, $areas);
            $tipPool->update(['status' => 'distributed']);
    
            DB::commit();
            Log::info("Distribución completada exitosamente");
    
            return redirect()->route('company.tip_pools.index')->with('success', 'Propinas distribuidas exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Error en la distribución: " . $e->getMessage());
            return back()->with('error', 'Error al distribuir las propinas: ' . $e->getMessage());
        }
    }
    
    
    private function validateDistribution(TipPool $tipPool)
    {
        if ($tipPool->status === 'distributed') {
            throw new \Exception("Este fondo de propinas ya ha sido distribuido.");
        }

        if ($tipPool->total_amount <= 0) {
            throw new \Exception("El monto total debe ser mayor a 0.");
        }

        if ($tipPool->date < date('Y-m-d')) {
            throw new \Exception("La fecha no puede ser anterior a la actual.");
        }
    }
    
    private function getCompanyAreas()
    {
        $company = Auth::user()->company;
        $areas = Area::where('company_id', $company->id)->get();
        $totalPercentage = $areas->sum('tip_percentage');
    
        if (abs($totalPercentage - 100) > 0.01) {
            throw new \Exception("La suma de los porcentajes de las áreas debe ser 100%. Actual: " . $totalPercentage);
        }
    
        return $areas;
    }
    
    private function distributeToAreas(TipPool $tipPool, $areas)
    {
        foreach ($areas as $area) {
            $areaTipAmount = $tipPool->total_amount * ($area->tip_percentage / 100);
            $this->distributeToEmployees($tipPool, $area, $areaTipAmount);
        }
    }
    
    private function distributeToEmployees(TipPool $tipPool, Area $area, $areaTipAmount)
    {
        $employeeShifts = WorkShift::whereHas('employee', function ($query) use ($area) {
            $query->where('area_id', $area->id);
        })->where('date', $tipPool->date)->get();
    
        $totalHours = $employeeShifts->sum('hours_worked');
    
        if ($totalHours > 0) {
            foreach ($employeeShifts as $shift) {
                $employeeTipAmount = $areaTipAmount * ($shift->hours_worked / $totalHours);
                $this->createTipDistribution($tipPool, $shift, $area, $employeeTipAmount);
            }
        } else {
            Log::warning("No se encontraron horas trabajadas para el área {$area->name}");
        }
    }
    
    private function createTipDistribution(TipPool $tipPool, WorkShift $shift, Area $area, $amount)
    {
        $tipDistribution = TipDistribution::create([
            'tip_pool_id' => $tipPool->id,
            'employee_id' => $shift->employee_id,
            'area_id' => $area->id,
            'amount' => $amount
        ]);
    
        Log::info("Creada distribución ID: {$tipDistribution->id} para empleado ID: {$shift->employee_id}, monto: {$amount}");
    }
}