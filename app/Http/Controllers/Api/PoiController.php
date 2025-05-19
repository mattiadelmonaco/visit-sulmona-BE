<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointOfInterest;
use App\Models\Type;
use Illuminate\Http\Request;

class PoiController extends Controller
{
    public function index() {

        $poi = PointOfInterest::with('firstImage', 'type')->get();

        return response()->json([
            "success" => true,
            "data" => $poi
        ]);
    }

    public function show(PointOfInterest $poi) {

        $poi->load([
        'type',
        'images',
        'tags',
        'daysOfWeek' => function ($query) {
            $query->orderBy('id');
        },
    ]);

        return response()->json([
            "success" => true,
            "data" => $poi
        ]);
    }

    public function indexByType($typeId) {

    $poi = PointOfInterest::with('firstImage', 'type')
            ->where('type_id', $typeId)
            ->get();

        return response()->json([
            "success" => true,
            "data" => $poi
        ]);
    }

    public function indexTypes() {

        $types = Type::all();

        return response()->json([
            "success" => true,
            "data" => $types
        ]);
    }
}
