<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'orderdate',
        'total',
        'voucher_id',
        'feeship',
        'totalmoney',
        'customer_receive',
        'status',
        'methodpayment_id'
    ];
}
