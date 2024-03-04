<?php

namespace App\Exports;
use App\Models\BedSpace;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Room;



class OccupiedSpaces implements FromQuery, WithHeadings
{
    
    private $param;


    public function __construct($propertyId)
    {
        $this->param = $propertyId;
    }
    public function query()
    {
        if ($this->param == 'all') {
            return BedSpace::select('propertyId', 'RoomId', 'spaceId', 'isAllocated')
                ->where('isAllocated', 'yes')->orderBy('propertyId')->orderBy('roomId');
        } else {
            return BedSpace::select('propertyId', 'RoomId', 'spaceId', 'isAllocated')->where('propertyId', $this->param)
            ->where('isAllocated', 'yes')->orderBy('propertyId')->orderBy('roomId');
        }
    }
    public function headings(): array
    {
        return ["Property", "Room", "Bed Space", "Allocated"];
    }
}
