<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Payback extends JsonResource
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
            'percentage' => $this->percentage,
            'total' => $this->total,
            'on' => $this->on
        ];
        // return parent::toArray($request);
    }
}
