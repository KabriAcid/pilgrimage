<?php

namespace App\Http\Controllers;

use App\Models\Alhaji;
use App\Models\BedSpace;
use App\Models\Property;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StorePropertyRequest;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $properties = Property::all();

        return view('property.add', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $validatedData = $request->validated();

        $property = Property::createProperty($validatedData);
        //Property::createRooms($property);

        return redirect()->back()->with('success',   'new property has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function propertyDetails($id)
    {
        $property = Property::where('propertyId', $id)->first();
        $rooms = $property->rooms()->paginate(5);
        $availableSpaces = BedSpace::where('propertyId', $property->propertyId)->where('isAllocated', 'no')->count();
        $allocatedSpaces = BedSpace::where('propertyId', $property->propertyId)->where('isAllocated', 'Yes')->count();
        $uploadedBedSpaces = BedSpace::where('propertyId', $property->propertyId)->count();
        return view('property.property-details', [
            'property' => $property, 'rooms' => $rooms,
            'allocated' => $allocatedSpaces, 'unallocated' => $availableSpaces,
            'uploadedSpaces' => $uploadedBedSpaces
        ]);
    }
    public function propertyFloorRooms($propertyId, $floorNumber)
    {
        $floorInitial = substr($floorNumber, 0, 1);

        $floor = $this->getFloor($floorInitial);
        $rooms = Room::where('propertyId', $propertyId)->where('floorNumber',  $floorNumber)->paginate(25);
        // $rooms = Room::where('propertyId', $propertyId)->where('roomId', 'LIKE', $floorInitial . '%')->paginate(25);
        $room = $rooms[0];


        return view('property.add-rooms-and-spaces', ['rooms' => $rooms, 'floor' => $floor, 'propertyId' => $propertyId, 'floorNumber' => $floorNumber]);
    }

    public function storePropertyPicture(Request $request, $propertyId)
    {

        $request->validate([
            'picture' => 'required|image|max:3000',
        ]);
        // $avatarName = Auth()->user()->email.'.'.$request->avatar->getClientOriginalExtension();
        $pictureName = time() . '.' . $request->picture->getClientOriginalExtension();
        $request->picture->move(public_path('properties_pictures'),  $pictureName);
        //dd($avatarName);
        $property = Property::where('propertyId', $propertyId)->update(['propertyimg' => $pictureName]);
        // dd($property);


        //$property->update(['propertyimg' => $pictureName]);

        return back()->with('success', 'Picture updated successfully.');
    }

    public function bedSpaceDetails($propertyId, $roomId, $bedSpaceId)
    {

        $bedSpace = BedSpace::where('propertyId', $propertyId)->where('roomId', $roomId)
            ->where('spaceId', $bedSpaceId)->first();
        $bedSpaces = null;

        $alhaji = Alhaji::where('alhajiId', $bedSpace->alhajiId)->first();
        if ($alhaji != null && $alhaji->count() > 0) {
            $bedSpaces = BedSpace::where('alhajiId', $alhaji->alhajiId)->get();
            return view('alhaji.bed-space', ['alhaji' => $alhaji, 'otherSpaces' => $bedSpaces]);
        } else {
            return back()->with('danger', 'The Space has not been allocayed yet.');
        }
    }

    public function addRoomsAndSpaces(Request $request)
    {
        $request->validate([
            'numberOfRooms' => 'required|numeric',
            'from' => 'required|numeric',
            'to' => 'required|numeric',
            'bedSpaces' => 'required|numeric',
            
            
        ]);
        $numberOfRooms = $request->input('numberOfRooms');
        $from = $request->input('from');
        $to = $request->input('to');
        $bedSpaces = $request->input('bedSpaces');
        $floorNumber = $request->input('floorNumber');
        $propertyId = $request->input('propertyId');
     //   dd($floorNumber,  $propertyId);

     DB::transaction(function () use ($from, $numberOfRooms, $propertyId, $floorNumber, $bedSpaces ) {
        for ($i = 1; $i <=  $numberOfRooms; $i++) {
            Room::create(
                [
                    'roomId' =>  $from,
                    'propertyId' =>  $propertyId,
                    'floorNumber' =>  $floorNumber,
                    'isFull' =>  'No',
                ]
               

            );
            for ($j =1; $j<= $bedSpaces; $j++ ){
                BedSpace::create(
                    [
                        'spaceId' => '00'.$j,
                        'roomId' =>  $from,
                        'propertyId' =>  $propertyId,
                        'isAllocated' => 'No',
                    ]
                );

            }
            $from = $from +1;
        }});
        return back()->with('sucess', $numberOfRooms. 'rooms with .'. $bedSpaces. ' have been uploaded');
    }

    private function getFloor($tt)
    {
        $floor = 'ground';
        if ($tt == 0) {
            $floor = 'Ground';
        } elseif ($tt == 1) {
            $floor = 'First';
        } elseif ($tt == 1) {
            $floor = 'Second';
        } elseif ($tt == 3) {
            $floor = 'Third';
        } else {
            $floor = $tt . 'th';
        }
        return $floor;
    }
}
