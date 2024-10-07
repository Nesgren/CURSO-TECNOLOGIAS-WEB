<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Employee;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function create(Employee $employee)
    {
        $company = Auth::user()->company;
        $areas = $company->areas;
        return view('company.invitations.create', compact('employee', 'areas'));
    }

    public function store(Request $request, Employee $employee)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id'
        ]);

        $company = Auth::user()->company;

        Invitation::create([
            'company_id' => $company->id,
            'employee_id' => $employee->id,
            'area_id' => $request->area_id,
        ]);

        return redirect()->route('company.employees.index')->with('success', 'Invitation sent successfully.');
    }

    public function accept(Invitation $invitation)
    {
        $invitation->update(['status' => 'accepted']);
        $invitation->employee->update(['area_id' => $invitation->area_id]);
    
        return redirect()->route('employee.dashboard')->with('success', 'Has aceptado la invitación al área.');
    }

    public function reject(Invitation $invitation)
    {
        $invitation->update(['status' => 'rejected']);

        return redirect()->route('employee.dashboard')->with('success', 'Invitation rejected.');
    }
}