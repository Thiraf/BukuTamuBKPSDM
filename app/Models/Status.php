<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $table = 'statuses';

    protected $primaryKey = 'id_status';

    protected $fillable = [
        'status_name',
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
    public function bukuTamus()
    {
        return $this->hasMany(BukuTamu::class, 'id_status');
    }
}
