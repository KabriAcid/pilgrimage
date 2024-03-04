<?php

namespace App\Http\Controllers;

use App\Exports\ExportAlhazai;
use App\Exports\ExportOfficials;
use App\Imports\AlhajisImport;
use App\Imports\OfficialImport;
use App\Models\Alhaji;
use App\Models\BedSpace;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAlhajiREquest;
use Maatwebsite\Excel\Facades\Excel;

class AlhajiController extends Controller
{
    public function index()
    {

        return view('alhaji.manage-alhazai');
    }

    public function getForm () {
        return view('alhaji.alhaji-form');
    }

    public function storeAlhaji(StoreAlhajiREquest $request)  {
        $validatedAlhaji= $request->validated();
        $alhaji = Alhaji::registerAlhaji($validatedAlhaji);
        return redirect()->back()->with('success',   'new Alhaji has been added');
    }
    public function manageOfficials()
    {

        return view('alhaji.manage-officials');
    }
    public function alhazaiExcelTemplate()
    {
        return Excel::download(new ExportAlhazai, 'alhazai.xlsx', null, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);
    }
    public function  officialExcelTemplate()
    {
        return Excel::download(new ExportOfficials, 'officials.xlsx', null, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);

    }
   
    public function storeUploadedAlhazai(Request $request)
    {

        $import = new AlhajisImport;
        Excel::import(
            $import,
            $request->file('file')->store('files')
        );
        // dd($import);
        // dd('Row count: ' . $import->getRowCount());
        return redirect()->back()->with('success', $import->getRowCount() . '   Alhazai records have been uploaded successufully');
    }
    public function storeUploadedOfficials(Request $request)
    {

        $import = new OfficialImport;
        Excel::import(
            $import,
            $request->file('file')->store('files')
        );
        // dd($import);
        // dd('Row count: ' . $import->getRowCount());
        return redirect()->back()->with('success', $import->getRowCount() . '   Official records have been uploaded successufully');
    }
    
    public function listAlhazai( Request $request)
    {

        $alhazai = Alhaji::latest()->paginate(25);
        $toSearch = $request->get('searchString');

        if ($toSearch != "") {
            $alhazai = Alhaji::where('fullName', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('lga', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('town', 'LIKE', '%' . $toSearch . '%')->orWhere('accomodated', 'LIKE', '%' . $toSearch . '%')->paginate(25);
        }

        // dd($alhazai);
        return view('alhaji.alhazai-list', ['alhazai' => $alhazai]);




        
    }
    public function alhajiBedSpace($alhajiId)
    {
        // dd($alhajiId);
        $bedSpaces = BedSpace::where('alhajiId', $alhajiId)->get();
        // dd ( $bedSpaces);
        $alhaji = Alhaji::where('alhajiId', $alhajiId)->first();
        //dd($alhaji);
        return view('alhaji.bed-space', ['alhaji' => $alhaji, 'otherSpaces' => $bedSpaces]);
    }

    public function storeAlhajiPicture(Request $request, $alhajiId)
    {

        $request->validate([
            'picture' => 'required|image|max:3000',
        ]);
        $pictureName = time() . '.' . $request->picture->getClientOriginalExtension();
        $request->picture->move(public_path('alhazai_pictures'),  $pictureName);
        //dd($avatarName);
        $alhaji = Alhaji::where('alhajiId', $alhajiId)->update(['picture' => $pictureName]);
        // dd($property);


        //$property->update(['propertyimg' => $pictureName]);

        return back()->with('success', 'Picture updated successfully.');
    }
    public function filterAlhajis($lga)
    {
        //dd($lga);
        $filteredAlhajis = Alhaji::where('lga', $lga)->where('accomodated', 'No')->get();
        //dd( $filteredAlhajis);
        return response()->json($filteredAlhajis);
    }

    public function filterAlhajisByLgaAndGender($lga , $gender)
    {
     //  dd($gender. ''.$lga);
        $filteredAlhajis = Alhaji::where('lga', $lga)->where('gender', $gender)->where('accomodated', 'No')->get();
       // dd( $filteredAlhajis);
        return response()->json($filteredAlhajis);
    }
}
