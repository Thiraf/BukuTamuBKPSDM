<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    // Secara eksplisit mendefinisikan nama tabel
    protected $table = 'bidangs';

    // Primary key dari tabel
    protected $primaryKey = 'id_bidang';

    // Kolom yang bisa diisi secara massal (mass assignable)
    protected $fillable = [
        'nama_bidang',
        'is_active',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Definisi relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }

    // Definisi relasi dengan model Layanan (misalnya satu Bidang bisa memiliki banyak Layanan)
    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'id_bidang', 'id_bidang');
    }
    public function bukuTamus()
    {
        return $this->hasMany(BukuTamu::class, 'id_bidang');
    }
}
