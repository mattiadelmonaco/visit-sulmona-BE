<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DayOfWeek;
use App\Models\Image;
use App\Models\PointOfInterest;
use App\Models\Tag;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PointOfInterestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pointsOfInterest = PointOfInterest::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        
        return view("points-of-interest.index", compact("pointsOfInterest"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::where('user_id', Auth::id())->get();

        $tags = Tag::where('user_id', Auth::id())->get();

        $daysOfWeek = DayOfWeek::all();

        return view('points-of-interest.create', compact('types', 'tags', 'daysOfWeek'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newPoint = new PointOfInterest();

        $newPoint->user_id = Auth::id();

        $newPoint->name = $data["name"];
        $newPoint->type_id = $data["type_id"];
        $newPoint->address = $data["address"];
        $newPoint->phone_number = $data["phone_number"];
        $newPoint->email = $data["email"];
        $newPoint->external_link = $data["external_link"];
        $newPoint->latitude = $data["latitude"];
        $newPoint->longitude = $data["longitude"];
        $newPoint->start_date = $data["start_date"];
        $newPoint->end_date = $data["end_date"];
        $newPoint->description = $data["description"];
        
        if(array_key_exists("first_image", $data)) {
            $img_url = Storage::putFile('uploads', $data["first_image"]);

            $newPoint->first_image = $img_url;
        }

        $newPoint->save();

        if (isset($data['tags'])) {
            $newPoint->tags()->attach($data['tags']); // se ci sono tag li associa al point inserendo righe nella tabella pivot
        }

        if (isset($data['hours'])) { // se ci sono orari li associa ad ogni giorno della settimana nelle colonne della tabella pivot
            foreach ($data['hours'] as $dayId => $times) {
                $newPoint->daysOfWeek()->attach($dayId, [
                    'first_opening' => $times['first_opening'] ?? null,
                    'first_closing' => $times['first_closing'] ?? null,
                    'second_opening' => $times['second_opening'] ?? null,
                    'second_closing' => $times['second_closing'] ?? null,
                ]);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) { // se ci sono immagini le salva nella cartella uploads
                $path = Storage::disk('public')->putFile('uploads', $image);

                $newPoint->images()->create([ // e poi nel database
                    'path' => $path,
                ]);
            }
        }

    
    return redirect()->route('points-of-interest.show', $newPoint->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(PointOfInterest $points_of_interest)
    {

        $points_of_interest->load([ // carica tutte le relazioni
        'type',
        'images',
        'tags',
        'daysOfWeek' => function ($query) { // ordina giorni della settimana in base all'id (da lunedi a domenica)
            $query->orderBy('id');
        },
    ]);

        return view("points-of-interest.show", compact("points_of_interest"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PointOfInterest $points_of_interest)
    {
        $types = Type::where('user_id', Auth::id())->get();

        $tags = Tag::where('user_id', Auth::id())->get();

        $daysOfWeek = DayOfWeek::all();
        $images = Image::whereHas('pointOfInterest', function ($query) { // prende le immagini associate all'id dell'user
        $query->where('user_id', Auth::id());
        })->get();

        return view('points-of-interest.edit', compact('points_of_interest', 'types', 'tags', 'daysOfWeek', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PointOfInterest $points_of_interest)
    {
        $data = $request->all();

        $points_of_interest->name = $data["name"];
        $points_of_interest->type_id = $data["type_id"];
        $points_of_interest->address = $data["address"];
        $points_of_interest->phone_number = $data["phone_number"];
        $points_of_interest->email = $data["email"];
        $points_of_interest->external_link = $data["external_link"];
        $points_of_interest->latitude = $data["latitude"];
        $points_of_interest->longitude = $data["longitude"];
        $points_of_interest->start_date = $data["start_date"];
        $points_of_interest->end_date = $data["end_date"];
        $points_of_interest->description = $data["description"];

        if (array_key_exists("first_image", $data)) { // se nella richiesta c'è un'immagine
            if (!empty($points_of_interest->first_image)) { // se è già presente un'immagine la cancella
            Storage::delete($points_of_interest->first_image);
        }
        $img_url = Storage::putFile("uploads", $data["first_image"]); // poi la carica nella cartella uploads
        $points_of_interest->first_image = $img_url; // poi la carica nel database
}

        if($request->has("tags")) {
            $points_of_interest->tags()->sync($data["tags"]); // se ci sono i tag nella richiesta rimuove i vecchi e aggiunge i nuovi con sync
        } else {
            $points_of_interest->tags()->detach(); // se non ci sono tag nella richiesta (tolti quelli inseriti precedentemente) li rimuove dal database con detach
        }

        if (isset($data['hours'])) {
        $points_of_interest->daysOfWeek()->detach(); // se nella richiesta ci sono gli orari li cancella con detach

        foreach ($data['hours'] as $dayId => $times) {
            $points_of_interest->daysOfWeek()->attach($dayId, [ // poi li ricarica con attach
                'first_opening' => $times['first_opening'] ?? null,
                'first_closing' => $times['first_closing'] ?? null,
                'second_opening' => $times['second_opening'] ?? null,
                'second_closing' => $times['second_closing'] ?? null,
            ]);
            }
        } else {
            $points_of_interest->daysOfWeek()->detach(); // altrimenti se non ci sono li rimuove dal database
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('public')->putFile('uploads', $image); // se nella richiesta ci sono immagini le aggiunge in uploads

                $points_of_interest->images()->create([
                    'path' => $path, // e le aggiunge nel database
                ]);
            }
        }

        $points_of_interest->update();

        return redirect()->route("points-of-interest.show", $points_of_interest->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PointOfInterest $points_of_interest)
    {
        if (!empty($points_of_interest->first_image) && Storage::disk('public')->exists($points_of_interest->first_image)) {
            Storage::disk('public')->delete($points_of_interest->first_image); // per rimuovere immagine copertina
    }

        foreach ($points_of_interest->images as $image) {
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path); // per rimuovere immagini da public (o uploads)
        }
        $image->delete(); // per cancellarle dal database
    }

        $points_of_interest->delete();

        return redirect()->route("points-of-interest.index");
    }

    public function search(Request $request)
    {
        $query = $request->input('query'); // valore del testo inserito nella searchbar
        $pointsOfInterest = PointOfInterest::where('user_id', Auth::id())
            ->where('name', 'LIKE', "%{$query}%") // cerca dove nel nome c'è una parte della query
            ->orderBy('id', 'desc')
            ->get();

        return view('points-of-interest.search', compact('pointsOfInterest', 'query'));
    }
}
