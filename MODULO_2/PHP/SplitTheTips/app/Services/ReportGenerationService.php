<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportGenerationService
{
    public function generateMonthlyReport($year, $month, $companyId)
    {
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        return DB::table('tip_pools')
            ->select(
                DB::raw('SUM(total_amount) as total_tips'),
                DB::raw('AVG(total_amount) as average_tips'),
                DB::raw('COUNT(*) as days_with_tips')
            )
            ->whereBetween('date', [$startDate, $endDate])
            ->where('company_id', $companyId)
            ->first();
    }
}