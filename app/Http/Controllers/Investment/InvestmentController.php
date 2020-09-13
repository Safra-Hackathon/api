<?php

namespace App\Http\Controllers\Investment;

use App\Entities\Investments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Investment\UpdateUserInvestmentRequest;
use App\Http\Resources\Investment as InvestmentResource;

class InvestmentController extends Controller
{
     /**
     * Get User Investments
     *
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = Auth::user();
        $investment = $user->investment()->first();

        $data = [];
        if ($investment) {
            $data = new InvestmentResource($investment);
            $investment->available = $user->payback()->first()->total;
        }

        return response()->json($data);
    }


     /**
     * Update Investments
     *
     *
     * @param UpdateUserInvestmentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserInvestmentRequest $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        $investments = $request->toArray();

        $investment = Investments::updateOrCreate(
            ['user_id' => $userId],
            $investments
        );
        $investment->available = $user->payback()->first()->total;

        $data = new InvestmentResource($investment);

        return response()->json($data);
    }
}
