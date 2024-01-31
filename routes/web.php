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
    return Inertia::render('Dashboard', [
        'locations' => Location::count()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/locations', [LocationController::class, 'index'])->name('locations');
    Route::get('/locations/create', [LocationController::class, 'new'])->name('locations.index');
    Route::post('/locations/create', [LocationController::class, 'create'])->name('locations.create');
    Route::get('/locations/{id}', [LocationController::class, 'show'])->name('location.show');
    Route::put('/locations/{id}', [LocationController::class, 'update'])->name('location.update');
    Route::get('/locations/{id}/delete', [LocationController::class, 'delete'])->name('location.delete');
    
    Route::get('/locations/{location}/moments/create', [MomentController::class, 'new'])->name('moment.new');
    Route::post('/locations/{location}/moments/create', [MomentController::class, 'create'])->name('moment.create');
    Route::get('/locations/{location}/moments/{id}', [MomentController::class, 'show'])->name('moment.show');
    Route::put('/locations/{location}/moments/{id}', [MomentController::class, 'update'])->name('moment.update');
    Route::get('/locations/{location}/moments/{id}/delete', [MomentController::class, 'delete'])->name('moment.delete');
});

require __DIR__.'/auth.php';
