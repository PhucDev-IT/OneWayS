<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'group',
        'guard_name'
    ];

    public function roleUsers(){
        return $this->belongsToMany(User::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}
