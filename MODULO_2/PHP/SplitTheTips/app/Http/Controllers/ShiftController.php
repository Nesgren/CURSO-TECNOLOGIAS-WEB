<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Auth::user()->company->shifts;
        return view('shifts.index', compact('shifts'));
    }

    public function create()
    {
        return view('shifts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'employee_id' => 'required|exists:employees,id'
        ]);

        Shift::create($request->all());

        return redirect()->route('company.shifts.index')->with('success', 'Turno creado con éxito.');
    }

    public function show(Shift $shift)
    {
        return view('shifts.show', compact('shift'));
    }

    public function edit(Shift $shift)
    {
        return view('shifts.edit', compact('shift'));
    }

    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'employee_id' => 'required|exists:employees,id'
        ]);

        $shift->update($request->all());

        return redirect()->route('company.shifts.index')->with('success', 'Turno actualizado con éxito.');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return redirect()->route('company.shifts.index')->with('success', 'Turno eliminado con éxito.');
    }

    public function availableShifts()
    {
        $availableShifts = Shift::where('employee_id', null)->get();
        return view('employee.available-shifts', compact('availableShifts'));
    }

    public function acceptShift(Shift $shift)
    {
        $shift->update(['employee_id' => Auth::user()->id]);
        return redirect()->route('employee.schedule')->with('success', 'Turno aceptado con éxito.');
    }

    public function rejectShift(Shift $shift)
    {
        // Lógica para rechazar un turno, si es necesario
        return redirect()->route('employee.schedule')->with('success', 'Turno rechazado.');
    }
}