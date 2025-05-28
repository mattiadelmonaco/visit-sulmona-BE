<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\PointOfInterestsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\TypesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function () {
	Route::get('/index', [DashboardController::class, 'index'])
	->name('dashboard');
});

Route::resource("images", ImagesController::class)
->middleware(["auth", "verified"]);


Route::resource("types", TypesController::class)
->middleware(["auth", "verified"]);

Route::resource("tags", TagsController::class)
->middleware(["auth", "verified"]);

Route::resource("points-of-interest", PointOfInterestsController::class) // ::resource crea le 7 rotte REST
    ->middleware(["auth", "verified"]);

Route::get('/search', [PointOfInterestsController::class, 'search']) // ::get crea una rotta specifica
    ->middleware(["auth", "verified"])
    ->name('points-of-interest.search'); // dando un nome alla rotta posso richiamarla con quel nome, 
                                        // cosi se in futuro cambia url non devo modificare le views

require __DIR__.'/auth.php';
