<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointOfInterest;
use App\Models\Type;
use Illuminate\Http\Request;

class PoiController extends Controller
{

    protected $macroCategories = [ // protected cosi può essere gestita solo dentro la classe o sottoclassi
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


    public function index(Request $request) {

        $limit = $request->query('limit');

        $query = PointOfInterest::with('type')->orderBy('id', 'desc');

        if ($limit) {
        $poi = $query->limit($limit)->get(); // se c'è un limite restituisce il numero di poi in base al limite
        } else {
        $poi = $query->get(); // altrimenti li restituisce tutti
        }

        $totalPoi = PointOfInterest::count(); // serve per contare tutti i poi (per tasto mostra tutti in FE)

        return response()->json([
            "success" => true,
            "data" => $poi,
            "totalPoi" => $totalPoi
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

    $poi = PointOfInterest::with('type') // restituisce i poi con quel type id
            ->where('type_id', $typeId)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            "success" => true,
            "data" => $poi
        ]);
    }

    public function indexTypes() {

        $types = Type::all(); // prende tutti i type (per select in FE)

        return response()->json([
            "success" => true,
            "data" => $types
        ]);
    }

    public function indexByMacroCategory($macroCategory)
    {
        if (!isset($this->macroCategories[$macroCategory])) { // controlla se la categoria (type) esiste nella macrocategoria
            return response()->json([
                'success' => false,
                'message' => 'Categoria non trovata'
            ], 404);
        }

        $typeNames = $this->macroCategories[$macroCategory]; // estrae l'elenco dei type associati

        $poi = PointOfInterest::with('type')
            ->whereHas('type', function ($query) use ($typeNames) { // filtra i poi in base ai types presenti in typeNames
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
