<?php

namespace App\Http\Controllers\Charts;

use App\Entities\PaybackTransactionsHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaybackHistoryChartController extends Controller
{
    /**
     * Update Profile
     *
     *
     * @param string $start
     * @param string $end
     * @return \Illuminate\Http\JsonResponse
     */
    public function history(string $start, string $end)
    {
        $userId = Auth::user()->id;
        $paybackHistory = PaybackTransactionsHistory::select(
                DB::raw("LEFT(date::TEXT, 7) as year_month"),
                DB::raw('SUM(payback_generated) as payback')
            )
            ->where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->groupBy('year_month')
            ->get()
            ->sortBy('year_month')
            ->map(function ($item) {
                return collect([$item->year_month => $item->payback]);
            })
            ->reverse()
            ->toArray();

        $paybackHistory = array_values($paybackHistory);

        return response()->json($paybackHistory);
    }
}
