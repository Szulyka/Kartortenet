<?php

namespace App\Http\Controllers;

use App\Models\CrashEvent;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CrashEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->check()) { 
            Session::flash('notLoggedIn'); 
            return redirect()->route('home');
          
        }
        if (Auth::user()->is_admin == 0) {
            Session::flash('notAdmin');
            return to_route('home');
            
        }

        return view('crashEvents.addCrashEvent', ['vehicles' => Vehicle::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'place'=> 'required',
            'date'=> 'required|date|before:today',
            'description' => 'required',
            'cars'=> 'required'
        ]);


        $c = CrashEvent::create($validated);
        $c ->vehicles()->sync($request->cars);

        Session::flash('crashEventAdded');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(CrashEvent $crashEvent)
    {
        if (!auth()->check()) { 
            Session::flash('notLoggedIn'); 
            return redirect()->route('home');
          
        }
        if (Auth::user()->is_premium == 0) {
            Session::flash('notPremium');
            return to_route('home');
        }
        return view('crashEvents/listEvents', [
            'crashEvent'=> $crashEvent,
            'vehicles' => $crashEvent->vehicles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CrashEvent $crashEvent)
    {
        if (!auth()->check()) { 
            Session::flash('notLoggedIn'); 
            return redirect()->route('home');
          
        }
        if (Auth::user()->is_admin == 0) {
            Session::flash('notAdmin');
            return to_route('home');
            
        }

        return view('crashEvents.editCrashEvent', [
            'crashEvent' => $crashEvent,
            'vehicles' => Vehicle::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CrashEvent $crashEvent)
    {
        $validated = $request->validate([
            'place'=> 'required',
            'date'=> 'required|date|before:today',
            'description' => 'required',
            'cars'=> 'required'

        ]);
        
        $crashEvent->update($validated);
        $crashEvent->vehicles()->sync($request->cars);
        
        Session::flash('crashEventEdited');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrashEvent $crashEvent)
    {
        if (!auth()->check()) { 
            Session::flash('notLoggedIn'); 
            return redirect()->route('home');
          
        }
        if (Auth::user()->is_admin == 0) {
            Session::flash('notAdmin');
            return redirect()->route('home');
            
        }
        $crashEvent->delete();
        Session::flash('deletedCE');
        return redirect()->route('home');
    }

}
