<?php

namespace App\Http\Controllers;

use Nnjeim\World\World;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //
    public function countries()
    {
        return response()->json(World::countries());
    }

    public function states($country_id)
    {
        return response()->json(World::states([
            'filters' => ['country_id' => $country_id]
        ]));
    }

    public function cities($state_id)
    {
        return response()->json(World::cities([
            'filters' => ['state_id' => $state_id]
        ]));
    }
}
