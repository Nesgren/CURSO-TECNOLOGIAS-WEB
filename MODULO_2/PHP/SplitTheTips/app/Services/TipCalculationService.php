<?php

namespace App\Services;

use App\Models\Tip;
use Illuminate\Support\Facades\Auth;

class TipCalculationService
{
    public function calculateAndSaveTips(array $data)
    {
        foreach ($data['employee_tips'] as $employeeId => $amount) {
            Tip::create([
                'company_id' => Auth::user()->company_id,
                'employee_id' => $employeeId,
                'amount' => $amount,
                'date' => now(),
            ]);
        }
    }
}