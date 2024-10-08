<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pegawais';

    // Primary Key
    protected $primaryKey = 'id_pegawai';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nik',
        'nama',
        'bidang',
        'layanan',
        'nomor_hp',
        'tanggal_lahir',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    // Kolom-kolom yang secara otomatis akan di-cast ke tipe tertentu
    protected $casts = [
        'tanggal_lahir' => 'date',
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Definisi relasi ke tabel lain (jika ada)
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }

    // Jika Pegawai terkait dengan Buku Tamu
    public function bukuTamu()
    {
        return $this->hasMany(BukuTamu::class, 'id_pegawai', 'id_pegawai');
    }

    // Definisi relasi dengan model lain yang terkait (misal ke bidang, layanan, dll.)
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}

