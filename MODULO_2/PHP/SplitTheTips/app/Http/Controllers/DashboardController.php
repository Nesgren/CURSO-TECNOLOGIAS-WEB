<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'company') {
            $company = $user->company;
            $areas = $company->areas;
            $employees = $company->employees;
            
            $tipData = $this->calculateTips($employees);
            
            return view('dashboard.company', compact('company', 'areas', 'employees', 'tipData'));
        } else {
            $employee = $user->employee;
            $tipData = $this->calculateEmployeeTips($employee);
            
            
            return view('dashboard.employee', compact('employee', 'tipData'));
        }
    }

    private function calculateTips($employees)
    {
        $tipData = [
            'daily' => [],
            'weekly' => [],
            'biweekly' => [],
            'monthly' => [],
        ];

        foreach ($employees as $employee) {
            $tipData['daily'][$employee->id] = $employee->tips()->whereDate('date', Carbon::today())->sum('amount');
            $tipData['weekly'][$employee->id] = $employee->tips()->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
            $tipData['biweekly'][$employee->id] = $employee->tips()->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->startOfMonth()->addDays(14)])->sum('amount');
            $tipData['monthly'][$employee->id] = $employee->tips()->whereMonth('date', Carbon::now()->month)->sum('amount');
        }

        return $tipData;
    }

    private function calculateEmployeeTips($employee)
    {
        return [
            'daily' => $employee->tips()->whereDate('date', Carbon::today())->sum('amount'),
            'weekly' => $employee->tips()->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount'),
            'biweekly' => $employee->tips()->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->startOfMonth()->addDays(14)])->sum('amount'),
            'monthly' => $employee->tips()->whereMonth('date', Carbon::now()->month)->sum('amount'),
        ];
    }
}