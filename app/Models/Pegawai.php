<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'id_bidang',
        'unit_kerja_pegawai',
        'jabatan_pegawai',
        'id_layanan',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];


    protected $casts = [
        'tanggal_lahir' => 'date',
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }

    public function bukuTamu()
    {
        return $this->hasMany(BukuTamu::class, 'id_pegawai', 'id_pegawai');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang', 'id_bidang');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}

