<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index(Request $request, Role $role)
    {
        return view('roles.users', compact('role'));
    }
}
