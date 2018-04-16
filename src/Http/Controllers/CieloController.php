<?php

namespace Iget\CieloCheckout\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Iget\CieloCheckout\Models\CieloOrder;
use Illuminate\Http\Request;

class CieloController extends BaseController
{
    use ValidatesRequests;

    /**
     * Receives Transaction Notification from Cielo
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function notify(Request $request)
    {
        $order = CieloOrder::find($request->order_number);

        if ($order) {
            $order->notification = $request->all();
            $order->payment_status = $request->payment_status;
            $order->save();

            \Log::info("Received transaction notification for Order \"{$request->order_number}\".");
        }

        return $this->responseOk();
    }

    /**
     * Receives Status Change Notification from Cielo
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function status(Request $request)
    {
        $order = CieloOrder::find($request->order_number);

        if ($order) {
            $order->payment_status = $request->payment_status;
            $order->save();

            \Log::info("Received status change notification for Order \"{$request->order_number}\". New Status is \"{$request->payment_status}\".");
        }

        return $this->responseOk();
    }

    /**
     * Default OK response
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function responseOk()
    {
        return response("<status>OK</status>");
    }
}
