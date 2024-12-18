<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusHistory extends Model
{
    protected $fillable = [
        'id_dashboard_admin',
        'username_admin',
        'old_status',
        'new_status',
        'updated_at',
    ];

    public function dashboardAdmin()
    {
        return $this->belongsTo(DashboardAdmin::class, 'id_dashboard_admin');
    }
}
