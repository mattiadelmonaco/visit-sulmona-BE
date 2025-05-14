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
        $pointsOfInterest = PointOfInterest::with('firstImage')->get();
        
        return view("points-of-interest.index", compact("pointsOfInterest"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $tags = Tag::all();
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

        $newPoint->save();

        if (isset($data['tags'])) {
            $newPoint->tags()->attach($data['tags']);
        }

        if (isset($data['hours'])) {
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
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('public')->putFile('uploads', $image);

                $newPoint->images()->create([
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

        $points_of_interest->load([
        'type',
        'images',
        'tags',
        'daysOfWeek' => function ($query) {
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
        $types = Type::all();
        $tags = Tag::all();
        $daysOfWeek = DayOfWeek::all();
        $images = Image::all();

        return view('points-of-interest.edit', compact('points_of_interest', 'types', 'tags', 'daysOfWeek', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
