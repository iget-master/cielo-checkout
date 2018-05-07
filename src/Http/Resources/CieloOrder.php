<?php

namespace Iget\CieloCheckout\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CieloOrder extends Resource
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
            'order_id' => $this->resource->order_id,
            'payment_status' => $this->resource->payment_status,
            'body' => $this->resource->body,
            'notification' => $this->resource->notification,
        ];
    }
}
