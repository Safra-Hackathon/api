<?php

namespace App\Http\Controllers\Payback;

use App\Entities\UserPaybackHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Payback\UpdateUserPaybackRequest;
use App\Http\Resources\Payback as PaybackResource;
use App\Http\Resources\PaybackHistory as PaybackHistoryResource;

class PaybackController extends Controller
{
     /**
     * Get Login User
     *
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = Auth::user();
        $payback = $user->payback()->firstOrCreate(
            ['user_id' => $user->id],
            [
                'percentage' => 0,
                'total' => 0,
                'goal' => 0,
                'on' => false
            ]);
        $data = new PaybackResource($payback);

        return response()->json($data);
    }


     /**
     * Update Profile
     *
     *
     * @param UpdateUserPaybackRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserPaybackRequest $request)
    {
        $user = Auth::user();
        $payback = $user->payback()->first();
        $payback->update($request->toArray());
        $data = new PaybackResource($payback);

        return response()->json($data);
    }


    /**
     * Update Profile
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function history()
    {
        $userId = Auth::user()->id;
        $paybackHistory = UserPaybackHistory::where('user_id', $userId)->get()->transform(function ($item) {
            return new PaybackHistoryResource($item);
        });

        return response()->json($paybackHistory);
    }

}
