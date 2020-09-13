<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Investment extends JsonResource
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
            'available' => $this->available,
            'investments' => $this->investments
        ];
        // return parent::toArray($request);
    }
}
