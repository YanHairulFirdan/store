<?php

namespace App\Http\Controllers;

use App\City;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Regency $regency)
    {

        $districts = $regency->districts;
        return response()->json($districts);
    }
}
