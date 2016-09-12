<?php

namespace Iget\CieloCheckout\Events;

use Iget\CieloCheckout\Models\CieloOrder;
use Illuminate\Queue\SerializesModels;

class PaymentStatusHasChanged
{
    use SerializesModels;

    /**
     * @var Iget\CieloCheckout\Models\CieloOrder
     */
    public $cieloOrder;

    /**
     * @var int
     */
    public $newStatus;

    /**
     * @var int
     */
    public $oldStatus;

    /**
     * PaymentStatusHasChanged constructor.
     *
     * @param \Iget\CieloCheckout\Models\CieloOrder $cieloOrder
     * @param int $oldStatus
     * @param int $newStatus
     */
    public function __construct(CieloOrder $cieloOrder, $oldStatus, $newStatus)
    {
        $this->cieloOrder = $cieloOrder;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}
