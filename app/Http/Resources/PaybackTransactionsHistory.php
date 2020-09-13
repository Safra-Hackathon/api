<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaybackTransactionsHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'information' => $this->transaction_information,
            'amount' => $this->transaction_amount,
            'percentage' => $this->payback_percentage,
            'payback' => $this->payback_generated,
            'payback_total' => $this->payback_total
        ];
    }
}
