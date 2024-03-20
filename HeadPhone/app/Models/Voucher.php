<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;


    protected $fillable = [
        'voucher_id',
        'name',
        'description',
        'discount',
        'type',
        'quantity',
        'used',
        'status',
        'start_time',
        'end_time'
    ];

    protected static function boot()
    {
        parent::boot();

        // Sự kiện trước khi tạo mới order
        static::creating(function ($voucher) {
            $voucher->voucher_id = self::generateRandomString();
        });
    }


    public static function generateRandomString($length = null) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $length = $length ?? rand(8, 10);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    
        return $randomString;
    }
}
