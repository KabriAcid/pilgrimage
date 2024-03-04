<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alhaji extends Model
{
  use HasFactory;
  protected $primaryKey = ['alhajiId'];
  //This is very necessary when varchar was used as a primary key
  public $incrementing = false;
  protected $fillable = ['alhajiId', 'fullName', 'passportNo', 'healthStatus', 'lga', 'town', 'gender', 'hajjYear', 'airLifted', 'accomodated', 'isOfficial'];
  public function bedSpace()
  {
    return BedSpace::where('alhajiId', $this->alhajiId)->get();
  }
  public static function registerAlhaji($data)
  {
    $alhaji = new Alhaji();
    $alhaji->alhajiId = $data['alhajiId'];
    $alhaji->fullName = $data['fullName'];
    $alhaji->passportNo = $data['passportNo'];
    $alhaji->healthStatus = $data['healthStatus'];
    $alhaji->lga = $data['lga'];
    $alhaji->town = $data['town'];
    $alhaji->gender = $data['gender'];
    $alhaji->hajjYear = $data['hajjYear'];
    $alhaji->airLifted = 'No';
    $alhaji->accomodated = 'No';
    $alhaji->isOfficial= 'No';

    if (isset($data['pictureFile'])) {
      //dd($data['pictureFile']);
      $pictureName = time() . '.' . $data['pictureFile']->getClientOriginalExtension();
      $alhaji->picture = $pictureName;

      $data['pictureFile']->move(public_path('alhazai_pictures'), $pictureName);
    }
    $alhaji->save();
  }
}
