<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    /**
     * View all properties list
     * 
     * @return View
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Property::class);
        
        return view('properties.index');
    }
    /**
     * Shows a single property image page
     */
    public function show(Property $property)
    {
        $property->load('user');
        
        return view('properties.show', compact('property'));
    }
}
