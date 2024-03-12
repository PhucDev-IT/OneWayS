<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'orderdate',
        'total',
        'voucher_id',
        'feeship',
        'totalmoney',
        'address_id',
        'method_payment'
    ];

    protected static function boot()
    {
        parent::boot();

        // Sự kiện trước khi tạo mới order
        static::creating(function ($order) {
            $latestOrder = static::latest()->first();

            // Nếu có order trước đó, tăng số lên 1, ngược lại, bắt đầu từ 1
            $orderNumber = $latestOrder ? intval(substr($latestOrder->order_id, 2)) + 1 : 1;

            // Format số thành chuỗi với độ dài 6 và thêm vào order_id
            $order->order_id = 'OR' . str_pad($orderNumber, 6, '0', STR_PAD_LEFT);
        });
    }

    public function details()
    {
        //Quan hệ 1-n
        return $this->hasMany(OrderDetails::class);
    }
}
