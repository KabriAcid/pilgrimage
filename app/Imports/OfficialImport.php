<?php

namespace App\Imports;

use App\Models\Alhaji;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OfficialImport implements ToModel, WithHeadingRow

{
    private $rows = 0;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
      //  dd($row);
      ++$this->rows;
        return new Alhaji([
            'alhajiId' => $row['id'],
            'fullName' => $row['name'],
            'passportNo' => $row['passport_number'],
            'healthStatus' => $row['health_status'],
            'isOfficial' => 'Yes',
            'lga' => $row['local_government'],
            'town' => $row['town'],
            'gender' => $row['gender'],
            'hajjYear' => $row['hajj_year'],
            'airLifted' => 'No',
            'accomodated' => 'No',
            
        ]);

      
    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
}
