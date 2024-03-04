<?php

namespace App\Http\Controllers;

use App\Models\Alhaji;
use App\Models\BedSpace;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpaceAllocationController extends Controller
{
    public function index()
    {
        $lgas = Alhaji::select('lga')->groupBy('lga')->get();
        $properties = Property::all();
        $unAccomdated = Alhaji::where('accomodated', 'No')->get();
        //dd (   $unAccomdated);
        return view('allocation.manage-allocation', [
            'lgas' => $lgas,
            'properties' => $properties, 'unaccomodatedAlhajis' => $unAccomdated
        ]);
    }

    public function allocateToOfficials()
    {
        $officials = Alhaji::where('accomodated', 'No')->where('isOfficial', 'Yes')->get();
        $properties = Property::all();
        $rooms = Room::all();

        return view('allocation.allocate-space-to-officials', [
            'officials' => $officials, 'properties' => $properties,
            'rooms' => $rooms
        ]);
    }

    public function storeAllocation(Request $request)
    {
        $alhajiId = $request->input('alhajiId');
        $propertyId = $request->input('propertyId');
        $roomId = $request->input('roomId');
        $spaces  = $request->input('spaces');
        // dd($alhajiId, $propertyId,     $roomId,  $spaces);
        $spaces = BedSpace::where('propertyId', $propertyId)->where('roomId', $roomId)->limit($spaces)->get();
        // dd($spaces);

        $alhaji = Alhaji::where('alhajiId', $alhajiId)->update(['accomodated' => 'yes']);
        //$count = 0;
        foreach ($spaces as $bedSpace) {
            //$count =$count+1;
            BedSpace::where('spaceId', $bedSpace->spaceId)->where('propertyId', $propertyId)
                ->where('roomId', $roomId)->update(
                    ['isAllocated' => 'Yes', 'alhajiId' => $alhajiId]


                );
        }
        // dd($count);

        return back()->with('success', $alhajiId . ' Has been allocated ' . count($spaces) . '  bed spaces in room   ' . $roomId . '  of' . $propertyId);
    }
    public function allocationByLgaAndGender(Request $request)
    {
        $request->validate([
            'alhazai' => 'required',
        ]);
        $alhazai = $request->input('alhazai');
        //  dd($alhazai );

        $numberofAlhazai = count($alhazai);
        //  dd($numberofAlhazai);
        $propertyId = $request->input('propertyId');
        $bedSpace = BedSpace::where('propertyId', $propertyId)->where('isAllocated', 'no')->orderBy('roomId')->limit($numberofAlhazai)->get();
        //dd ($bedSpace[3]);

        $numberOfBedSpace = count($bedSpace);
        //dd($numberofAlhazai);
        // dd( $numberOfBedSpace );
        if ($numberOfBedSpace < $numberofAlhazai) {
            // return response()->json(['error' => 'Not enough bed spaces available'], 422);

            return back()->with('danger', 'Not enough bed spaces available');
        }
        //$keys = array_keys($alhazai);

        for ($i = 0; $i < $numberOfBedSpace; $i++) {
            // dd($alhazai[0]);


            $alhaji = Alhaji::where('alhajiId', $alhazai[$i])->update(['accomodated' => 'yes']);

            //dd($bedSpace[$i]->propertyId);
            $updatedRow = BedSpace::where('spaceId', $bedSpace[$i]->spaceId)
                ->where('roomId', $bedSpace[$i]->roomId)->where('propertyId', $bedSpace[$i]->propertyId)
                ->update(
                    ['alhajiId' =>  $alhazai[$i], 'isAllocated' => 'yes']
                );
        }
        return back()->with('success', count($alhazai) . ' Alhazai accomodated successfully.');
    }

    public function specialAllocation(Request $request)
    {

        $alhazai = Alhaji::where('accomodated', 'No')->latest()->paginate(10);
        $toSearch = $request->get('searchString');

        if ($toSearch != "") {
            $alhazai = Alhaji::where('fullName', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('lga', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('town', 'LIKE', '%' . $toSearch . '%')->orWhere('accomodated', 'No')->paginate(25);
        }
        $bedSpaces = BedSpace::where('isAllocated', 'No')->orderBy('roomId')->get();
        return view('allocation.special', ['alhazai' => $alhazai, 'bedSpaces' => $bedSpaces]);
    }
    public function storeSpecialAllcation(Request $request)
    {
        $request->validate([
            'bedSpace' => 'required',
            'alhajiId' => 'required',
        ]);
        $string = $request->input('bedSpace');
        $alhajiId = $request->input('alhajiId');
        DB::transaction(function () use ( $string, $alhajiId ) {
        });
       
        $parts = explode("/", $string);
        // Accessing individual parts
        $spaceId = $parts[0]; // "008"
        $roomId = $parts[1]; // "104"
        $propetyId = $parts[2]; // "PP1"
       $alhaji= Alhaji::where('alhajiId', $alhajiId)->update(['accomodated' => 'yes']);
      $bedSpace =  BedSpace::where('spaceId', $spaceId)->where('roomId', $roomId)->where('propertyId', $propetyId)->update(

            ['alhajiId' =>  $alhajiId, 'isAllocated' => 'yes'],
        );
        //dd( $bedSpace);
        return back()->with('success',  ' Alhazai accomodated successfully.');
    }
}
