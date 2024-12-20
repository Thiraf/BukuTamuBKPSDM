<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id_role';

    protected $fillable = [
        'nama_role',
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

    public function admins()
    {
        return $this->hasMany(Admin::class, 'id_role', 'id_role');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

}
