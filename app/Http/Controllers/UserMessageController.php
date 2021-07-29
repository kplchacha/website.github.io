<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
    /**
     * Show a list of messages between the authenticated users and the speciefied uses
     * via the route parameter
     * 
     * @param User $user other user
     */
    public function index(User $user)
    {
        return view('users.messages.index', [
            'user' => $user
        ]);
    }
}
