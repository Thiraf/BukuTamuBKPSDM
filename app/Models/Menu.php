<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel
    protected $table = 'menus';

    // Primary key dari tabel
    protected $primaryKey = 'id_menu';

    // Kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'menu',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Definisi relasi dengan model User (untuk tracking user yang menambah atau mengubah data)
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }
}
