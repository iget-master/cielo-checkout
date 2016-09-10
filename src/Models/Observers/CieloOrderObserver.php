<?php

namespace Iget\CieloCheckout\Models\Observers;

use Iget\CieloCheckout\Models\CieloOrder;

class CieloOrderObserver
{
    /**
     * Automatically create unique random order_id
     *
     * @param \Iget\CieloCheckout\Models\CieloOrder $model
     * @return bool
     */
    public function creating(CieloOrder $model)
    {
        do {
            $order_id = str_random(32);
        } while (CieloOrder::where('order_id', '=', $order_id)->count());

        $model->order_id = $order_id;

        return true;
    }
}
