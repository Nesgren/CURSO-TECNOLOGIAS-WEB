<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class TipController extends Controller
{
    public function calculate()
    {
        $company = Auth::user()->company;
        $employees = $company->employees;
        
        return view('company.tips.calculate', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_tips' => 'required|numeric|min:0',
            'date' => 'required|date',
            'employee_tips' => 'required|array',
            'employee_tips.*' => 'required|numeric|min:0',
        ]);

        $company = Auth::user()->company;

        foreach ($request->employee_tips as $employeeId => $amount) {
            Tip::create([
                'company_id' => $company->id,
                'employee_id' => $employeeId,
                'amount' => $amount,
                'date' => $request->date,
            ]);
        }

        return redirect()->route('company.tips-history')->with('success', 'Propinas registradas correctamente.');
    }

    public function history()
    {
        $company = Auth::user()->company;
        $tips = Tip::where('company_id', $company->id)
                   ->with('employee')
                   ->orderBy('date', 'desc')
                   ->paginate(15);

        return view('company.tips.history', compact('tips'));
    }
}