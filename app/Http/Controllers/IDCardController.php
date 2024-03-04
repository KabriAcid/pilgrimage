<?php

namespace App\Http\Controllers;
use App\Models\Alhaji;

use Illuminate\Http\Request;

class IDCardController extends Controller
{
    
    public function show(Request $request)
    {
        
        $alhazai = Alhaji::where('accomodated', "yes")->paginate(10);
        $toSearch = $request->get('searchString');

        if ($toSearch != "") {
            $alhazai = Alhaji::where('fullName', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('lga', 'LIKE', '%' . $toSearch . '%')
                ->orWhere('town', 'LIKE', '%' . $toSearch . '%')->orWhere('accomodated', 'LIKE', '%' . $toSearch . '%')->paginate(25);
        }
       
        
        return view('alhaji.id-card', ['alhazai' => $alhazai]); // Pass array to Blade view
    }
}
