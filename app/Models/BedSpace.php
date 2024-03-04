<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedSpace extends Model
{
    use HasFactory;
    protected $primaryKey = ['spaceId','roomId','propertyId'];
      //This is very necessary when varchar was used as a primary key
    public $incrementing = false;
    protected $fillable = ['spaceId','roomId', 'isAllocated', 'propertyId', 'alhajiId'];

    public function room()
    {
        return $this->belongsTo(Room::class,  'roomId', 'roomId');//, [ 'propertyId', 'propertyId']);
    }
}
