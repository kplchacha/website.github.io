<?php

namespace App\Http\Controllers;

use App\Models\RoomUser;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Displays a single tenant information
     * 
     * @return View
     */
    public function show(RoomUser $roomUser)
    {
        $roomUser->load(['room', 'user', 'payments']);

        return view('tenants.show', compact('roomUser'));
    }
}
