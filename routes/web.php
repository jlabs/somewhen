<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\MomentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Location;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'locations' => Location::with('moments.author')->get()
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations');
    Route::get('/locations/new', [LocationController::class, 'new'])->name('locations.index');
    Route::get('/locations/edit/{id}', [LocationController::class, 'edit'])->name('location.edit');
    Route::post('/locations/new', [LocationController::class, 'create'])->name('locations.new');
    
    Route::get('/locations/{location}/moments/new', [MomentController::class, 'new'])->name('moment.new');
    Route::get('/locations/{location}/moments/{id}', [MomentController::class, 'edit'])->name('moment.edit');
});

require __DIR__.'/auth.php';
