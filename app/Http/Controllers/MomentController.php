<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Moment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MomentController extends Controller
{
    public function show($location, $id, Request $request)
    {
        $location = Location::findOrFail($location);
        $moment = Moment::findOrFail($id);

        return Inertia::render('Moments/Update', [
            'location' => [
                'id' => $location->id,
                'title' => $location->title
            ],
            'moment' => [
                'id' => $moment->id,
                'title' => $moment->title,
                'image' => $moment->image,
                'delete_url' => route('moment.delete', ['location' => $location, 'id' => $moment]),
                'source' => $moment->source, 
                'date_taken' => $moment->date_taken, 
                'direction' => $moment->direction, 
                'description' => $moment->description, 
            ]
        ]);
    }

    public function update($location, $id, Request $request)
    {
        $moment = Moment::findOrFail($id);

        $moment->update([
            'title' => $request->get('title'),
            'source' => $request->get('source'), 
            'date_taken' => $request->get('date_taken'), 
            'direction' => $request->get('direction'), 
            'description' => $request->get('description'), 
        ]);

        $moment->save();
    }

    public function new($location, Request $request)
    {
        return Inertia::render('Moments/Create');
    }

    public function delete($location, $id, Request $request)
    {
        Moment::destroy($id);

        $location = Location::findOrFail($location);

        return redirect("/locations/{$location->id}");
    }
}
