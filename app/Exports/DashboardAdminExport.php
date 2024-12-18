<?php

namespace App\Exports;

use App\Models\DashboardAdmin;
use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardAdminExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DashboardAdmin::all();
    }
}
