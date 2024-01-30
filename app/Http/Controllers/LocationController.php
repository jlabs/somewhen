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
        return Inertia::render('Locations/Create');
    }

    public function create(Request $request)
    {
        Location::create($request->validate([
            'title' => ['required', 'max:50'],
            'coordinates' => 'required',
        ]));

        return redirect()->back();
    }

    public function show($id)
    {
        $location = Location::with('moments')->findOrFail($id);

        return Inertia::render('Locations/Update', [
            'id' => $location->id,
            'title' => $location->title,
            'colour' => $location->colour,
            'button_label' => $location->button_label,
            'coordinates' => $location->coordinates,
            'gmaps_url' => $location->gmaps_url,
            'delete_url' => route('location.delete', $location),
            'moments' => $location->moments
        ]);
    }

    public function delete($id, Request $request)
    {
        Location::destroy($id);

        return redirect('/locations');
    }

    public function update($id, Request $request)
    {
        $location = Location::with('moments')->findOrFail($id);

        $coordinates = explode(',', $request->get('coordinates'));

        $location->update([
            'title' => $request->get('title'),
            'colour' => $request->get('colour'),
            'button_label' => $request->get('button_label'),
            'coordinates' => [
                'lat' => $coordinates[0],
                'lng' => $coordinates[1]
            ],
            'gmaps_url' => $request->get('gmaps_url'),
        ]);

        $location->save();
    }
}
