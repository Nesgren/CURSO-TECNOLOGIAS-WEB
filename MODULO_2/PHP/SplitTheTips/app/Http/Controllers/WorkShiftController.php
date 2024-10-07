<?php

namespace App\Http\Controllers;

use App\Models\WorkShift;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WorkShiftAssigned;
use Carbon\Carbon;

class WorkShiftController extends Controller
{
    public function index()
    {
        $workShifts = WorkShift::with('employee')->orderBy('date', 'desc')->get();
        return view('company.work_shifts.index', compact('workShifts'));
    }

    public function create()
    {
        $company = Auth::user()->company;
        $workShifts = WorkShift::all();

        if (!$company) {
            return redirect()->back()->with('error', 'No tienes una compañía asociada.');
        }

        $employees = $company->employees;

        return view('company.work_shifts.create', compact('employees', 'workShifts'));
    }

    public function edit(WorkShift $workShift)
    {
    $employees = Auth::user()->company->employees;
    return view('company.work_shifts.edit', compact('workShift', 'employees'));
    }

    public function update(Request $request, WorkShift $workShift)
    {
    $validatedData = $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'date' => 'required|date',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
    ]);

    $workShift->update($validatedData);

    return redirect()->route('company.work_shifts.index')
                     ->with('success', 'Work shift updated successfully.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'employee_id' => 'required|exists:employees,id',
            'send_notification' => 'nullable|boolean',
            'frequency' => 'required|in:once,weekly,monthly,always',
            'repeat_count' => 'required_unless:frequency,always|integer|min:1|max:12',
        ]);
    
        // Obtener el company_id del usuario autenticado
        $companyId = Auth::user()->company->id;
    
        $startDate = \Carbon\Carbon::parse($validatedData['date']);
        $frequency = $validatedData['frequency'];
        $repeatCount = $frequency === 'always' ? 1 : ($frequency === 'once' ? 1 : $validatedData['repeat_count']);
    
        // Calcular las horas trabajadas
        $startTime = \Carbon\Carbon::parse($validatedData['date'] . ' ' . $validatedData['start_time']);
        $endTime = \Carbon\Carbon::parse($validatedData['date'] . ' ' . $validatedData['end_time']);
    
        if ($endTime->lt($startTime)) {
            $endTime->addDay(); // Si la hora de fin es menor, asumimos que es del día siguiente
        }
    
        $hoursWorked = $startTime->floatDiffInHours($endTime);
    
        // Crear turnos según la frecuencia
        for ($i = 0; $i < $repeatCount; $i++) {
            $shiftDate = $startDate->copy();
    
            if ($frequency === 'weekly') {
                $shiftDate->addWeeks($i);
            } elseif ($frequency === 'monthly') {
                $shiftDate->addMonths($i);
            }
    
            WorkShift::create([
                'employee_id' => $validatedData['employee_id'],
                'company_id' => $companyId, // Aquí se añade el company_id
                'date' => $shiftDate->toDateString(),
                'start_time' => $validatedData['start_time'],
                'end_time' => $validatedData['end_time'],
                'hours_worked' => $hoursWorked,
            ]);
        }
    
        // Enviar notificación si se seleccionó
        if ($request->boolean('send_notification')) {
            $employee = Employee::find($validatedData['employee_id']);
            $employee->notify(new WorkShiftAssigned($shiftDate, $validatedData['start_time'], $validatedData['end_time']));
        }
    
        return redirect()->route('company.work_shifts.index')
                         ->with('success', 'Turno(s) de trabajo creado(s) exitosamente.');
    }    

    public function destroy(WorkShift $workShift)
    {
        $workShift->delete();
        return redirect()->route('company.work_shifts.index')->with('success', 'Turno de trabajo eliminado exitosamente.');
    }
}
