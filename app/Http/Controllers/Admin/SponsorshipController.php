<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Models\Doctor;
use App\Http\Requests\StoreSponsorshipRequest;
use App\Http\Requests\UpdateSponsorshipRequest;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logged_user = Auth::user();

        // Se utente logato ha il profilo 
        if ($logged_user->doctor) {
            // restituisce il dottore collegato allo user loggato 
            // resituisce array di lunghezza 1 (relazione one to one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            $doctor = $doctors[0];

            $sponsorships = Sponsorship::all();

            return view('admin.sponsorship', compact('doctor', 'sponsorships'));
        }
        // Altrimenti ti riporta sul Dashboard
        else {
            return redirect()->route('admin.dashboard.index');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSponsorshipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSponsorshipRequest $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
