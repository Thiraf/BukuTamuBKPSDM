<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel
    protected $table = 'accesses';

    // Primary key dari tabel
    protected $primaryKey = 'id_access';

    // Kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'id_role',
        'id_menu',
        'can_view',
        'can_create',
        'can_update',
        'can_delete',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Relasi dengan model Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    // Relasi dengan model Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }

    // Relasi dengan model User untuk tracking user yang menambah atau mengubah data
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }
}
