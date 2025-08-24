<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'contact',
        'amount',
        'currency',
        'status',
        'order_id',
        'payment_id',
        'signature',
        'payload'
    ];

    protected $casts = ['payload' => 'array'];
}
