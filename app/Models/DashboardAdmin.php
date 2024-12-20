<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardAdmin extends Model
{
    use HasFactory;

    protected $table = 'dashboard_admins';

    protected $primaryKey = 'id_dashboard_admin';

    protected $fillable = [
        'id_buku_tamu',
        'id_admin',
        'nip',
        'nama_pegawai',
        'jabatan_pegawai',
        'unit_kerja_pegawai',
        'tujuan_informasi',
        'id_bidang',
        'id_layanan',
        'id_status',
        'createdAdd',
        'updatedAdd',
        'userAdd',
        'created_at',
        'updated_at'
    ];

    // Kolom yang otomatis di-cast ke tipe tertentu
    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    // Definisi relasi dengan model BukuTamu
    public function bukuTamu()
    {
        return $this->belongsTo(BukuTamu::class, 'id_buku_tamu', 'id_buku_tamu');
    }
    // Definisi relasi dengan model Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
    // Definisi relasi dengan model User untuk tracking userAdd
    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }


    // app/Models/DashboardAdmin.php
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id_status');
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
