<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Funds extends JsonResource
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
            'name' => $this->name,
            'category' => $this->category,
            'interest' => $this->interest,
            'min' => $this->min,
            'admin_tax' => $this->admin_tax,
            'withdraw_time' => $this->withdraw_time
        ];
    }
}
