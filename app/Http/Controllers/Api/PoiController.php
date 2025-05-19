<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointOfInterest;
use Illuminate\Http\Request;

class PoiController extends Controller
{
    public function index() {

        $poi = PointOfInterest::all();

        return response()->json([
            "success" => true,
            "data" => $poi
        ]);
    }

    public function show() {
        return "sei nella show";
    }
}
