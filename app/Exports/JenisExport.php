<?php

namespace App\Exports;

use App\Models\Jenis;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\Before\Export;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;

class JenisExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Jenis::all();
    }

    public function headings(): array {
        return [
            'No.',
            'Nama Jenis',
            'Tanggal Input',
            'Tanggal Update'
        ];
    }
}
