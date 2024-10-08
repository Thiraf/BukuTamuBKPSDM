<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel
    protected $table = 'roles';

    // Primary key dari tabel
    protected $primaryKey = 'id_role';

    // Kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'nama_role',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Definisi relasi dengan model User untuk tracking user yang menambah atau mengubah data
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }

    // Definisi relasi dengan model Admin (jika satu role memiliki banyak admin)
    public function admins()
    {
        return $this->hasMany(Admin::class, 'id_role', 'id_role');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

}
