<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardAdminExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'ID Buku Tamu',
            'NIP',
            'Nama Pegawai',
            'Jabatan Pegawai',
            'Unit Kerja Pegawai',
            'Tujuan Informasi',
            'Bidang',
            'Layanan',
            'Waktu Input',
            'Status',
        ];
    }
}
