<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidangs';

    protected $primaryKey = 'id_bidang';

    protected $fillable = [
        'nama_bidang',
        'is_active',
        'userAdd',
        'createAdd',
        'updateAdd',
    ];

    protected $casts = [
        'createAdd' => 'datetime',
        'updateAdd' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userAdd', 'id');
    }

    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'id_bidang', 'id_bidang');
    }
    public function bukuTamus()
    {
        return $this->hasMany(BukuTamu::class, 'id_bidang');
    }
}
