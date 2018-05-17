<?php
namespace Iget\CieloCheckout\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CieloOrder extends Eloquent
{

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
        'payment_status',
        'notification',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'body' => 'array',
        'notification' => 'array',
    ];

    /**
     * The available payment status codes
     *
     * @var array
     */
    public static $availableStatuses = [
        1 => 'PENDING',
        2 => 'PAID',
        3 => 'DENIED',
        4 => 'EXPIRED',
        5 => 'CANCELED',
        6 => 'NOT_FINISHED',
        7 => 'AUTHORIZED',
        8 => 'CHARGEBACK',
    ];

    const STATUS_PENDING = 1;
    const STATUS_PAID = 2;
    const STATUS_DENIED = 3;
    const STATUS_EXPIRED = 4;
    const STATUS_CANCELED = 5;
    const STATUS_NOT_FINISHED = 6;
    const STATUS_AUTHORIZED = 7;
    const STATUS_CHARGEBACK = 8;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function payable()
    {
        return $this->morphTo();
    }
}