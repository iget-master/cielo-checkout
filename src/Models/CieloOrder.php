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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order',
        'payment_status',
        'notification',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order' => 'array',
        'notification' => 'array',
    ];
}