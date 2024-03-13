<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Sponsorship;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        if (!$logged_user->doctor) {
            return view('admin/dashboard', compact('logged_user'));
        } else {
            // Recupera il dottore associato all'utente loggato.

            $doctor = $logged_user->doctor;



            // Restituisce un array di lunghezza 1 (relazione one-to-one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->take(3)->get();
            $doctor = $doctors[0];

            

            // quantita di relazioni
            $sponsorships = $doctor->sponsorships();

            $current_date = Carbon::now();
          
            if($sponsorships->count() > 0) {
                $purchase_end_dates = $doctor->sponsorships()->withPivot('end_date')->get();
                foreach ($purchase_end_dates  as $purchase_end_date) {
                    // $start_date = $sponsorship->pivot->start_date;
                    $end_date = $purchase_end_date->pivot->end_date;
                    // dd($end_date);
                }
            } else {
                $end_date = '';
            }

            // Recupera i messaggi associati al dottore loggato
            $messages = Message::where('doctor_id', '=', $doctor->id)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
            // Restituisce la vista dell'elenco dei messaggi per l'amministratore,
            // passando l'array di messaggi come variabile compatta

            $reviews = Review::where('doctor_id', $doctor->id)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            return view('admin/dashboard', compact('doctor', 'messages', 'reviews','end_date', 'current_date'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
