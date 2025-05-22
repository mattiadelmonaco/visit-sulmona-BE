<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointOfInterest;
use App\Models\Type;
use Illuminate\Http\Request;

class PoiController extends Controller
{

    protected $macroCategories = [
        'cultura' => [
            'Evento', 'Monumento', 'Museo', 'Chiesa', 'Teatro', 'Cinema', "Galleria d'arte", 'Biblioteca'
        ],
        'tempolibero' => [
            'Evento', 'Parco', 'Stadio', 'Spiaggia', 'Mercato', 'Teatro', 'Cinema'
        ],
        'cibo' => [
            'Ristorante', 'Bar', 'Enoteca', 'Agriturismo'
        ],
        'ospitalità' => [
            'Hotel', 'BnB', 'Agriturismo'
        ],
        'commercio' => [
            'Negozio', 'Centro commerciale', 'Mercato'
        ],
        'comunità' => [
            'Associazione', 'Chiesa', 'Biblioteca'
        ],
        'natura' => [
            'Parco', 'Spiaggia', 'Agriturismo', 'Stadio'
        ],
    ];


    public function index() {

        $poi = PointOfInterest::with('type')->orderBy('id', 'desc')->get();

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

    $poi = PointOfInterest::with('type')
            ->where('type_id', $typeId)
            ->orderBy('id', 'desc')
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

    public function indexByMacroCategory($macroCategory)
    {
        if (!isset($this->macroCategories[$macroCategory])) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria non trovata'
            ], 404);
        }

        $typeNames = $this->macroCategories[$macroCategory];

        $poi = PointOfInterest::with('type')
            ->whereHas('type', function ($query) use ($typeNames) {
                $query->whereIn('name', $typeNames);
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'macro_category' => $macroCategory,
            'data' => $poi
        ]);
    }
}
