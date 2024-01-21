<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Moment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MomentController extends Controller
{
    public function edit($location, $id, Request $request)
    {
        $location = Location::findOrFail($location);
        $moment = Moment::findOrFail($id);

        return Inertia::render('Moments/Edit', [
            'location' => [
                'id' => $location->id,
                'title' => $location->title
            ],
            'moment' => [
                'id' => $moment->id,
                'title' => $moment->title
            ]
        ]);
    }

    public function new($location, Request $request)
    {
        return Inertia::render('Moments/New');
    }
}
