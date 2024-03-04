<?php

namespace App\Jobs;

use App\Models\BedSpace;
use App\Models\Property;
use App\Models\Room;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateBedSpacesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
   
    private $spaces;
    private $dakuna = 0;
    private $room;

    
    public function __construct($spcs, $rss, Room $room)
    {
        $this->spaces = $spcs->withoutRelations();
        $this->dakuna = $rss->withoutRelations();
        $this->room = $room->withoutRelations();
      //  dd($this->spaces);
        
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        dd($this->spaces);
        
        $allBedSpaces = $this->spaces;
        dd($allBedSpaces, $this->room);


        // for ($k = 1; $k <=  $bedSpacesPerRoom ; $k++) {
        //     BedSpace::create([
        //         'spaceId' => '00' . $k,
        //         'roomId' => $this->room->roomId,
        //         'propertyId' => $this->room->propertyId,
        //         'isAllocated' => 'no',
        //     ]);
        // }
    }
}
