<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search()
    {
        if (isset($_GET["search"])) {
            $search = $_GET["search"];

            $search = strtoupper($search);
            if (strlen($search) === 6) {
                $search = substr($search, 0, 3) . '-' . substr($search, 3);
            }

            $vehicle = Vehicle::where('license_plate', $search)->first();
            if ($vehicle) {
                return view('list', [
                    'vehicle' => $vehicle,
                    'crashes' => $vehicle->crashEvents
                ]);
            } 
            /*
            if ($vehicle->crashEvents->count() == 0) {
                Session::flash('vehicleNotInCrash');
            } 
            */else {
                Session::flash('noVehicle');
                return to_route('home');
                
            }
        }
    }

    public function manage() {
        if (!auth()->check()) { 
            Session::flash('notLoggedIn'); 
            return redirect()->route('home');
          
        }
        if (Auth::user()->is_admin == 0) {
            Session::flash('notAdmin');
            return redirect()->route('home');
            
        }
        return view('users',  ['users' => User::paginate(10)]);
    }

    public function update(Request $request)
    {
        if (!auth()->check()) { 
            Session::flash('notLoggedIn'); 
            return redirect()->route('home');
          
        }
        if (Auth::user()->is_admin == 0) {
            Session::flash('notAdmin');
            return redirect()->route('home');
            
        }
        $validated = $request->validate([
            'users'=> 'required'
        ]);
        $users = User::all();
        foreach($users as $user) {
            if (in_array($user->id, $validated['users'])) {
                $user->is_premium = 1;
                $user->save();
            } 
            else {
                $user->is_premium = 0;
                $user->save();
            }
        }
        
        Session::flash('usersModified');
        return redirect()->route('home');
    }
}
