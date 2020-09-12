<?php

namespace App\Http\Controllers\Payback;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Payback\UpdateUserPaybackRequest;
use App\Http\Resources\Payback as PaybackResource;

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
        $payback = $user->payback()->firstOrCreate([
            'user_id' => $user->id
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

}
