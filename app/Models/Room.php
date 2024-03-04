<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  use HasFactory;
  protected $primaryKey = ['roomId', 'propertyId'];
  //This is very necessary when varchar was used as a primary key
  public $incrementing = false;
  protected $fillable = ['roomId', 'propertyId', 'floorNumber', 'isFull'];

  public function property()
  {
    return $this->belongsTo(Property::class, 'propertyId', 'propertyId');
  }

  public function bedSpaces()
  {

    return $this->hasMany(BedSpace::class, 'roomId', 'roomId')
      ->where('propertyId', $this->propertyId)->get();
  }
  public static function createBedSpaces($propertyId, $roomId, $numberOfSpaces)
  {
    for ($i = 1; $i <= $numberOfSpaces; $i++) {
      $prefix = '00';
      if ($i > 9) {
        $prefix = '0';
      }
      $bedSpace = new BedSpace();
      $bedSpace->spaceID = $prefix . $i;
      $bedSpace->roomId = $roomId;
      $bedSpace->propertyId = $propertyId;
      $bedSpace->isAllocated = 'no';
      $bedSpace->save();
    }
  }
}
