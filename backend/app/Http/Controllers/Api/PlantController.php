<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function show($id)
    {
        $plants = config('medimart.plants');
        return response()->json([
            'name'          => $plants[$id]['name'],
            'scientific'    => $plants[$id]['scientific'],
            'uses'          => $plants[$id]['uses'],
            'heals'         => $plants[$id]['heals'],
            'preperation'   => $plants[$id]['preperation'],
            'photo'         => $plants[$id]['photo']
        ], 200);
    }
}
