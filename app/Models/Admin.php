<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'id_role',
        'username_admin',
        'password_admin',
        'userAdd',
        'created_at',
        'updated_at',
        'createAdd',
        'updateAdd',
    ];

    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }
    public function setPasswordAdminAttribute($value)
    {
        $this->attributes['password_admin'] = Hash::make($value);
    }
    public function getAuthPassword()
    {
        return $this->password_admin;
    }


}
