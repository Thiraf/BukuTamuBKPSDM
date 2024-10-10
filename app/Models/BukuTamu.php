<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;

class BukuTamu extends Model
{
    use HasFactory;

    protected $table = 'buku_tamus';

    protected $primaryKey = 'id_buku_tamu';

    protected $fillable = [
        'id_pegawai',
        'id_bidang',
        'id_layanan',
        'id_bidang',
        'nik',
        'tujuan_informasi',
        'nama_pegawai',
        'tempat_tanggal_lahir_pegawai',
        'nomor_hp_pegawai',
        'status',
        'createAdd',
        'updateAdd',
        'userAdd',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
    public function layanan()
    {
        return $this->belongsTo(Layanan::class,'id_layanan');
    }
    public function dashboardAdmin()
    {
        return $this->hasOne(DashboardAdmin::class, 'id_buku_tamu', 'id_buku_tamu');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

}
