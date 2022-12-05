<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;

class RealEstateController extends Controller
{


    public function show( RealEstate $realestate){
        return view('RealEstate.show', compact('realestate'));
    }


}
