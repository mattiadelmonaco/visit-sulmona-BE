<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
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
     * Per cancellare immagine singola dalla edit
     */
    public function destroy(Image $image)
    {
        if ($image->path && Storage::disk('public')->exists($image->path)) { // controlla se il file è presente nel database e nella cartella public
        Storage::disk('public')->delete($image->path); // cancella file da public
    }
        $image->delete(); // cancella dal database

        return redirect()->back()->withFragment('images'); // per tornare in quella parte della pagina
    }
}
