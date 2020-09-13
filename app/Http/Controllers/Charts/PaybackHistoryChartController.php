<?php

namespace App\Http\Controllers\Charts;

use App\Entities\PaybackTransactionsHistory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaybackHistoryChartController extends Controller
{
    protected $projectionDate;
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
        $currentDate = substr(Carbon::now()->toISOString(), 0, 10);
        if ($end > $currentDate) {
            $this->projectionDate = $end;
            $end = $currentDate;
        }

        $paybackHistory = PaybackTransactionsHistory::select(
                DB::raw("LEFT(date::TEXT, 7) as year_month"),
                DB::raw('MAX(payback_total) as payback')
            )
            ->where('user_id', $userId)
            ->whereBetween('date', [$start, $end])
            ->groupBy('year_month')
            ->get()
            ->sortBy('year_month')
            ->map(function ($item) {
                $key = $item->year_month . '-01';
                return collect([
                   $key  => $item->payback
                ]);
            })
            ->reverse()
            ->toArray();
        $paybackHistory = array_values($paybackHistory);

        $data = ['historico' => $paybackHistory];

        if ($this->projectionDate) {
            // TODO:
            // envia o payback histórico p/ o microserviço de projeção
            // recebe as projeções dos próximos x meses
            // coloca as projeções no array e retorna
            $paybackHistory = array_reverse($paybackHistory);
            $lastHistoryElement = array_pop($paybackHistory);
            $historyLen = count($paybackHistory) - 1;

            if ($historyLen > 1) {
                $beforeLast = (double) array_values($paybackHistory[$historyLen - 1])[0];
                $last = (double) array_values($paybackHistory[$historyLen])[0];
                $lastDateStr = array_key_last($paybackHistory[$historyLen]);
                $lastDate = Carbon::createFromFormat('Y-m-d', $lastDateStr);

                $rate = $last/$beforeLast;

                $lastDate->addMonth();
                $last *= $rate;
                $lastDateStr = substr($lastDate->toISOString(), 0, 10);
                $data['projetado'][] = [
                    $lastDateStr => number_format($last, 2)
                ];

                $lastDate->addMonth();
                $last *= $rate;
                $lastDateStr = substr($lastDate->toISOString(), 0, 10);
                $data['projetado'][] = [
                    $lastDateStr => number_format($last, 2)
                ];

                $lastDate->addMonth();
                $last *= $rate;
                $lastDateStr = substr($lastDate->toISOString(), 0, 10);
                $data['projetado'][] = [
                    $lastDateStr => number_format($last, 2)
                ];
            }

            $paybackHistory['historico'][] = $lastHistoryElement;
        }

        return response()->json($data);
    }
}
