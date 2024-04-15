<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'time',
        'rating',
        'product_id',
        'order_id',
        'parent_id',
        'title',
        'user_id'

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
