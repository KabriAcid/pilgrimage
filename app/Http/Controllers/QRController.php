<?php

namespace App\Http\Controllers;

use App\Models\Alhaji;
use App\Models\BedSpace;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function show(Request $request)
    {
        $qrCodes = [];
        $alhazai = Alhaji::where('accomodated', "yes")->get();
        $toSearch = $request->get('searchString');

        if ($toSearch != "") {
            $alhazai = Alhaji::where('fullName', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('lga', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('town', 'LIKE', '%' . $toSearch . '%')->orWhere('accomodated', 'LIKE', '%' . $toSearch . '%')->get();
        }

        
        foreach ($alhazai as $alhaji) {
            $id = $alhaji->alhajiId;
            $name = $alhaji->fullName;
            $country = "Nigeria";
            $state = "Katsina";
            $passport =$alhaji->passportNo;
            $hStatus =  $alhaji->healthStatus;
            $lga = $alhaji->lga;
            $town = $alhaji->town;
            $bedSpaces = $alhaji->bedSpace();
            $bedtext = '';
            foreach ($bedSpaces as $bedSpace) {
                $bedtext = $bedtext. $bedSpace->spaceId. ' in'. ' Room ' . $bedSpace->roomId . ' , Property ' . $bedSpace->propertyId . '\n';
            }
            $bedtextArray = explode('\n', trim($bedtext));
            $text = "Alhaji Id: $id\nName: $name\nCountry: $country\nPassport Number:$passport\nHealth Status:$hStatus\nState: $state\nLGA: $lga\nTown: $town\nBed Space(s): " . implode(", ", $bedtextArray);
            $qrCode = QrCode::size(90)->generate($text);
           // $qrCodeDataUri = QrCode::size(30)->dataUri($text); // Generate data URI string
           // $qrCodes[] = $qrCodeDataUri; // Add data URI string to array
           $qrCodes[] = $qrCode ;
        }
        return view('alhaji.qr', ['qrCodes' => $qrCodes]); // Pass array to Blade view
    }
}
