<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';

    protected $primaryKey = 'id_layanan';

    protected $fillable = [
        'nama_layanan',
        'id_bidang',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Definisi relasi dengan model Bidang
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }

    // Definisi relasi dengan model User (untuk tracking user yang menambah atau mengubah data)
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }
}
