<?php

namespace App\Exports;

use App\Models\Alhaji;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportAllAlhazai implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Alhaji::select('alhajiId', 'fullname', 'lga', 'town', 'gender', 'accomodated', 'hajjYear')
        ->where('hajjYear', '2023')->orderBy('alhajiId');
    }
    public function headings(): array
    {
        return ["ID", "Name", "Local Government","Town", "Gender", 'Accomodated', 'Hajj Year'];
    }
}
