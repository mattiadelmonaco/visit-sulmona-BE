<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get();

        return view("tags.index", compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tags.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = ucfirst(strtolower($data['name']));

        $newTag = new Tag();

        $newTag->user_id = Auth::id();

        $newTag->name = $data["name"];
        $newTag->color = $data["color"];

        $newTag->save();

        return redirect()->route("tags.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view("tags.edit", compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $data = $request->all();
        $data['name'] = ucfirst(strtolower($data['name']));

        $tag->name = $data["name"];
        $tag->color = $data["color"];

        $tag->update();

        return redirect()->route("tags.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route("tags.index");
    }
}
