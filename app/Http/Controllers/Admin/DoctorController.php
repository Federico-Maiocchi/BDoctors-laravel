<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // // Ottieni l'utente attualmente loggato
        // $logged_user = Auth::user();
        // // Recupera il dottore associato all'utente loggato.
        // // Restituisce un array di lunghezza 1 (relazione one-to-one)
        // $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
        // return view('admin.doctors.index', compact('doctors'));
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        // Se utente logato non ha il profilo te lo fa creare 
        if (!$logged_user->doctor) {
            $specializations = Specialization::orderBy('name', 'ASC')->get();

            return view('admin.doctors.create', compact('specializations'));
        }
        // Altrimenti ti riporta sul Dashboard
        else {
            return redirect()->route('admin.dashboard.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        $data = $request->all();

        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        $logged_user_id = $logged_user->id;

        $data['user_id'] = $logged_user_id;

        $doctor = Doctor::create($data);

        if ($request->has('specializations')) {
            $doctor->specializations()->sync($request->specializations);
        }

        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        // Verifica se il dottore fornito come parametro è associato all'utente loggato
        if ($doctor->user_id == $logged_user->id) {
            // Se il dottore è associato all'utente loggato, visualizza la vista del singolo dottore
            return view('admin.dashboard.index', compact('doctor'));
        } else {
            // Se il dottore non è associato all'utente loggato, visualizza una vista di errore
            return view('errors.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $logged_user = Auth::user();
        if ($doctor->user_id == $logged_user->id) {

            $specializations = Specialization::orderBy('name', 'ASC')->get();

            return view('admin.doctors.edit', compact('doctor', 'specializations'));
        } else {
            return view('errors.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $data = $request->all();

        // Se non e stata selezionata nuova foto va presa quella vecchia dal DB        
        if (!$data['photo']) {
            $data['photo'] = $doctor->photo;
        }

        $doctor->update($data);

        // Se value del form non e vuoto ti sostituisce i valori del DB con quelli del form
        if ($request->has('specializations')) {
            $doctor->specializations()->sync($request->specializations);
        }
        // Se il valore del form e vuoto ti va a cancellare tutti relazione nel DB
        else {
            $doctor->specializations()->detach();
        }

        return redirect()->route('admin.dashboard.index', $doctor);
    }

    public function restore($doctor_id)
    {
        // recuperato dottore incluso quelli eliminati dal database
        $doctor = Doctor::withTrashed()->where('id', $doctor_id)->first();

        // se il dottore non esiste, restituisci errore 404
        if (!isset($doctor)) {
            abort(404);
        }
        // se il dottore è stato eliminato, ripristinalo
        if ($doctor->trashed()) {
            $doctor->restore();
        }
        // ritorna alla pagina precedente
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($doctor_id)
    {
        // recupera il dottore incluso quelli eliminati dal database
        $doctor = Doctor::withTrashed()->where('id', $doctor_id)->first();
        // se il dottore non esiste, restituisci errore 404
        if (!isset($doctor)) {
            abort(404);
        }
        // rimuovi le associazioni con specializzazioni e sponsorizzazioni many to many
        $doctor->specializations()->sync([]);
        $doctor->sponsorships()->sync([]);

        if ($doctor->trashed()) {
            $doctor->forceDelete();
        } else {
            $doctor->delete();
        }

        return redirect()->route('admin.dashboard.index');
    }
}
