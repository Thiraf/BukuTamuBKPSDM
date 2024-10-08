<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel
    protected $table = 'admins';

    // Primary key dari tabel
    protected $primaryKey = 'id_admin';

    // Kolom yang bisa diisi secara massal (mass assignable)
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

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Relasi ke tabel Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    // Relasi ke tabel User untuk tracking user yang menambah atau mengubah data
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
