<?php

namespace App\Http\Controllers;

use App\Models\BedSpace;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function roomSpaces($propertyId, $roomId)
    {
        //dd($propertyId, $roomId);
        $room = Room::where('propertyId', $propertyId)->where('roomId', $roomId)->first();
        // dd($room);
        $bedSpaces = BedSpace::where('propertyId', $propertyId)->where('roomId', $roomId)->get();


        return view('room.room-bed-spaces', ['room' => $room, 'bedSpaces' => $bedSpaces]);
    }

    public function addRoomSpaces(Request $request)
    {
        
        $request->validate([
            'numberOfSpaces' => 'required|numeric',
        ]);
        Room::createBedSpaces(request('propertyId'), request('roomId'), request('numberOfSpaces'));
        return back()->with('success', 'Picture updated successfully.');

    }
}
