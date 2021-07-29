<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Permission;
use App\Models\Property;
use App\Models\Role;
use App\Models\RoomUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        /** @var User */
        $currentUser = Auth::user();

        //Properties Count
        $propertiesCount = Property::count();

        //Change properties count is user is property owner
        $propertiesCount = $currentUser->properties()->count();

        //Users Count
        $usersCount = User::count();

        //Roles Count
        $rolesCount = Role::count();

        //Permissions Count
        $permissionsCount = Permission::count();

        //Landlords Count
        /** @var Role */
        $propertyOwnerRole = Role::firstOrCreate(['title' => 'Property Owner']);
        $propertyOwnersCount = $propertyOwnerRole->users()->count();

        /** @var Role */
        $tenantRole = Role::firstOrCreate(['title' => 'Tenant']);
        $tenantsCount = $tenantRole->users()->count();

        //Payment Methods Count
        $paymentMethodsCount = PaymentMethod::count();

        return view('dashboard', compact(
            'propertiesCount', 
            'usersCount', 
            'propertyOwnersCount', 
            'tenantsCount',
            'rolesCount',
            'permissionsCount',
            'paymentMethodsCount'
        ));
    }
}
