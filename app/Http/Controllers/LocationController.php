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

    public function locations(Request $request)
    {
        return Inertia::render('Locations');
    }
}
