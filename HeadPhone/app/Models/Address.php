<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'province_id',
        'province_name',
        'district_id',
        'district_name',
        'ward_id',
        'ward_name',
        'details',
        'status',

    ];
}
