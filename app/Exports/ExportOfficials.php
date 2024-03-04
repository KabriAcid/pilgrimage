<?php

namespace App\Exports;

use App\Models\Alhaji;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportOfficials implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Alhaji::select('alhajiId', 'fullname', 'passportNo', 'healthStatus',  'lga', 'town', 'gender', 'hajjYear')
        ->where('hajjYear', '1960')->orderBy('alhajiId');
    }
    public function headings(): array
    {
        return ["ID", "Name", "Passport Number", "Health Status", "Local Government","Town", "Gender", 'Hajj Year'];
    }
}
