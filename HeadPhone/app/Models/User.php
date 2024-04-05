<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard_name = "web";

    protected $fillable = [
        'name',
        'birthOfDay',
        'gender',
        'email',
        'phone',
        'address_defaultid',
        'avatar',
        'password',
        'is_active',
        'coin',
        'createdat'

    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

 
    public function assignUserRole($roles)
    {
        // Kiểm tra nếu $roles là một vai trò duy nhất
        if (!is_array($roles)) {
            $roles = [$roles];
        }

        // Lặp qua mỗi vai trò và gán cho người dùng
        foreach ($roles as $role) {
            $roleModel = Role::where('name', $role)->first();

            if ($roleModel) {
                $this->roles()->attach($roleModel);
            }
        }

        return true;
    }
    public function getRoles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id', 'id', 'id')
            ->where('model_type', '=', 'App\Models\User');
    }

}
