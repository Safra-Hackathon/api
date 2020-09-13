<?php

namespace App\Http\Controllers\Fund;

use App\Entities\Funds;
use App\Http\Resources\Funds as FundsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FundController extends Controller
{
     /**
     * Get Funds
     *
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $funds = Funds::get()->transform(function ($item) {
            return new FundsResource($item);
        });

        return response()->json($funds);
    }


    /**
     * Recomenda o fundo com o maior rendimento cujo investimento mínimo é <= valor atual
     *
     *
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     */
    public function recommend($value)
    {
        $recommendedFund = Funds::where('min', '<=', $value)->orderBy('interest', 'desc')->first();

        if ($recommendedFund) {
            $recommendedFund = new FundsResource($recommendedFund);
        }

        return response()->json($recommendedFund);
    }
}
