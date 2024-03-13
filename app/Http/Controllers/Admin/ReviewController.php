<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        // Se utente logato ha il profilo 
        if ($logged_user->doctor) {
            // restituisce il dottore collegato allo user loggato 
            // resituisce array di lunghezza 1 (relazione one to one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            $doctor = $doctors[0];
            // Recupera le recensioni associate al dottore loggato
            $reviews = Review::where('doctor_id', '=', $doctor->id)
            ->orderBy('created_at', 'desc')->get();
            // Restituisce la vista dell'elenco delle recensioni per l'amministratore,
            // passando l'array di recensioni come variabile compatta
            return view('admin.reviews.index', compact('reviews', 'doctor'));
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
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        // Se utente logato ha il profilo 
        if ($logged_user->doctor) {
            // Recupera i medici associati all'utente loggato in base all'ID dell'utente
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            // Presumendo che ci sia almeno un medico associato all'utente,
            // recupera il primo medico dalla collezione
            $doctor = $doctors[0];

            // Verifica se la recensione specificata appartiene al medico loggato
            if ($review->doctor_id == $doctor->id) {
                // Se la recensione appartiene al medico loggato, visualizza la vista di dettaglio della recensione
                return view('admin.reviews.show', compact('review', 'doctor'));
            } else {
                // Se la recensione non appartiene al medico loggato, visualizza una vista di errore
                return view('errors.error');
            }
        }
        // Altrimenti ti riporta sul Dashboard
        else {
            return redirect()->route('admin.dashboard.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }
    
    public function restore($review_id)
    {
        $review = Review::withTrashed()->where('id', $review_id)->first();

        if (!isset($review)) {
            abort(404);
        }

        if ($review->trashed()) {
            $review->restore();
        }

        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($review_id)
    {

        $review = Review::withTrashed()->where('id', $review_id)->first();
        if (!isset($review)) {
            abort(404);
        }

        if ($review->trashed()) {
            $review->forceDelete();
        } else {
            $review->delete();
        }
        return redirect()->route('admin.reviews.index');
    }
}
