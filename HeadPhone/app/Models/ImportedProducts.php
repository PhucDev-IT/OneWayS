<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportedProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'import_information_id',
        'product_id',
        'quantity',
        'price'

    ];
}
