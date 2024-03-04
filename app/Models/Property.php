<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\CreateBedSpacesJob;

class Property extends Model
{
    use HasFactory;
    protected $primaryKey = ['propertyId'];
    //protected $keyType = 'string';
    //This is very necessary when varchar was used as a primary key
    public $incrementing = false;
    //protected $casts = ['id' => 'string'];

    protected $fillable = ['propertyId', 'name', 'location', 'distance', 'totalRooms', 'totalBedSpaces', 'address', 'hajjYear', 'propertyimg'];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'propertyId', 'propertyId');
    }

    // public function totalSpaces()
    // {
    //    // return intval($this->totalBedSpaces);
    //     return intval($this->totalBedSpaces);
    // }
    // public function totalRooms()
    // {
    //     return intval($this->totalRooms);
    // }



    public static function createProperty($data)
    {
        $property = new Property();

        $property->propertyId = $data['propertyId'];
        $property->name = $data['propertyname'];
        $property->location = $data['location'];
        $property->distance = $data['distance'];
        $property->address = $data['address'];
        $property->totalRooms = $data['numberOfRooms'];
        $property->numberOfFloor = isset($data['numberOfFloor']) ? $data['numberOfFloor'] : 0;
        $property->totalBedSpaces = $data['totalBedSpaces'];
        $property->hajjYear = $data['hajjYear'];

        if (isset($data['picture'])) {
            //dd($data['picture']);
            $pictureName = time() . '.' . $data['picture']->getClientOriginalExtension();
            $property->propertyimg = $pictureName;

            $data['picture']->move(public_path('properties_pictures'), $pictureName);
        }


        $property->save();

        return $property;
    }

    public static function createRooms(Property $property)
    {
        $numberOfRooms = $property->totalRooms;
        $numberOfFloors = $property->numberOfFloor;
        $numberOfRoomPerFloor = intval($numberOfRooms / $numberOfFloors);
        $spaces = $property->totalBedSpaces;
        


        //   dd($spaces );

        for ($i = 1; $i <= $numberOfFloors; $i++) {

            for ($j = 1; $j <= intval($numberOfRoomPerFloor); $j++) {


                if ($j > 9) {
                    $pre = intval($i);
                } else {
                    $pre = intval($i . '0');
                }
                $room =   Room::create(
                    [
                        'roomId'  =>  intval($pre . $j),
                        'propertyId' => $property->propertyId,
                        'floorNumber' => $i,
                        'isFull' => 'no',
                    ]
                );
                //dd( $spaces.''. $numberOfRooms. $room);
              //  $job = new CreateBedSpacesJob( $spaces, $numberOfRooms, $room);
               // dispatch($job);
               // Property::createBedSpaces($property, $room);
            }
        }
    }
    // public static function createBedSpaces(Property $property, Room $room)
    // {
    //     // dd($property);
    //     //dd($property->totalBedSpaces);
    //     $bedSpacesPerRoom = intval($property->totalBedSpaces / $property->totalRooms);
    //     // dd($bedSpacesPerRoom);

    //     for ($k = 1; $k <= $bedSpacesPerRoom; $k++) {
    //         BedSpace::create(
    //             [
    //                 'spaceId' => '00' . $k,
    //                 'roomId' => $room->roomId,
    //                 'propertyId' => $room->propertyId,
    //                 'isAllocated' => 'no',

    //             ]

    //         );
    //     }
    // }
}
