<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAllAlhazaiParam;
use App\Exports\ExportAllAlhazai;
use App\Exports\UploadedSpaces;
use App\Exports\OccupiedSpaces;
use App\Exports\UnOccupiedSpaces;
use App\Models\Alhaji;
use App\Models\BedSpace;
use App\Models\Property;

class ReportController extends Controller
{
    public function accomodationReport()
    {
    }

    public function allAlhazai()
    {
        return Excel::download(new ExportAllAlhazai, 'all_alhazai.xlsx', null, ['A', 'B', 'C', 'D', 'E', 'F']);
    }

    public function alhazaiByAccomodation($status)
    {

        return Excel::download(new ExportAllAlhazaiParam($status), $status . '.xlsx', null, ['A', 'B', 'C', 'D', 'E', 'F']);
    }
    public function uploadedSpaces()
    {
        $properties = Property::all();
        return view('report.uploaded_spaces', ['properties' => $properties]);
    }

    public function fetchUploadedSpaces()
    {
        $param = request('propertyId');
        return Excel::download(new UploadedSpaces($param), 'uploaded_spaces.xlsx', null, ['A', 'B', 'C', 'D']);
    }

    public function getOccupiedSpaces()
    {

        $properties = Property::all();
        return view('report.occupied_spaces', ['properties' => $properties]);
    }
    public function fetchOccupiedSpaces()
    {
        $param = request('propertyId');
        return Excel::download(new UnOccupiedSpaces($param), 'Unoccupied_spaces.xlsx', null, ['A', 'B', 'C', 'D']);
    }

    public function getUnOccupiedSpaces()
    {
        $properties = Property::all();
        return view('report.unoccupied_spaces', ['properties' => $properties]);
    }
    public function reportSummary()
    {

        $totalBedSpace = 0;

        $properties = Property::all();
        foreach ($properties as $property) {
            $totalBedSpace = $totalBedSpace + $property->totalBedSpaces;
        }
        $uploadedBedSpaces = count(BedSpace::all()) ;
        $alhazai = count(Alhaji::all());
        $alhazaiAccomodated =count(Alhaji::where('accomodated', 'Yes')->get());
        $alhazaiUnAccomodated =count(Alhaji::where('accomodated', 'No')->get());

        return view ('report.summary', ['totalSpaces' =>$totalBedSpace,
         'alhazai' => $alhazai, 'uploadedBedSpace' => $uploadedBedSpaces,
        'accomodated' => $alhazaiAccomodated, 'unAccomodated' => $alhazaiUnAccomodated]
        );
    }
}
