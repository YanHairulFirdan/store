<?php

namespace App\Http\Controllers;

use App\Models\Regency;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = Regency::get();
        return response()->json($cities);
    }
}
