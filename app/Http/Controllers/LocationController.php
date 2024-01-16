<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Moment;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function location($id, Request $request) 
    {
        $location = Location::find($id);
        return json_encode($location);
    }
}
