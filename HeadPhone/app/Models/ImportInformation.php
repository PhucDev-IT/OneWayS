<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'user_id',
        'supplier_id',
        'time'

    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function importedProducts(){
        return $this->hasMany(ImportedProducts::class);
    }
}
