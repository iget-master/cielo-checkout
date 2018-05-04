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
            'order_id' => $request->resource->order_id,
            'payment_status' => $request->resource->payment_status,
            'body' => $request->resource->body,
            'notification' => $request->resource->notification,
        ];
    }
}
