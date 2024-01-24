<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Moment;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function location($id, Request $request) 
    {
        $location = Location::with('moments.author')->find($id);
        return json_encode($location);
    }

    public function index(Request $request)
    {
        return Inertia::render('Locations/Index', [
            'locations' => Location::all()->map(function ($location) {
                return [
                    'id' => $location->id,
                    'title' => $location->title,
                    'edit_url' => route('location.update', $location),
                ];
            }),
        ]);
    }

    public function new(Request $request)
    {
        return Inertia::render('Locations/New');
    }

    public function create(Request $request)
    {
        Location::create($request->validate([
            'title' => ['required', 'max:50'],
            'coordinates' => 'required',
        ]));

        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $location = Location::with('moments')->findOrFail($id);

        return Inertia::render('Locations/Edit', [
            'location' => $location
        ]);
    }

    public function delete($id, Request $request)
    {

    }
}
