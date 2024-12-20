<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'menu',
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
}
