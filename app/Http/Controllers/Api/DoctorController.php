<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\APIStoreDoctorRequest;
use App\Models\Doctor;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(APIStoreDoctorRequest $request)
    {   //Recuperiamo tutti dati dalla richiesta API
        $data = $request->all();

        //Recuperiamo il tempo corrente
        $current_time = Carbon::now();

        /**
         * 
         *             DOCTORI SENZA SPONSORIZAZZIONE
         * 
         */

        //Prendiamo i dottori che non hanno sponsorship o quelli che l`hanno scaduto
        $doctors = Doctor::whereDoesntHave('sponsorships')->orWhereHas('sponsorships', function (Builder $query) use ($current_time) {
            $query->where('end_date', '<', $current_time);
        })->with('specializations', 'reviews', 'user', 'sponsorships')->withCount('reviews');

        //Filtriamo il resultato dei dottori con ASC o DESC uttilizando il parametro arrivato da API
        if (isset($data['order'])) {
            $doctors->orderBy('reviews_count', $data['order']);
        }
        ;

        //Filtriamo il resultato dei dottori in base a specializzazione scelta
        if (isset($data['specialization_id'])) {
            //Assegnamo a una nuova variabile il valore della specializzazione da cercare
            $specialization_id = $data['specialization_id'];

            //Cerchiamo i dottori che hanno una specifica specializzazione 
            $doctors->whereHas('specializations', function (Builder $query) use ($specialization_id) {
                $query->where('specialization_id', $specialization_id);
            });
        }
        ;

        //Colleghiamo tabella doctors con review e raggruppiamo per id dottore 
        $doctors->select('doctors.*', DB::raw('IFNULL(CAST(AVG(reviews.vote_id) AS UNSIGNED), 0) as media_voti'))
            ->leftJoin('reviews', 'doctors.id', '=', 'reviews.doctor_id')
            ->groupBy('doctors.id')
            ->withCount('reviews');

        //Se non arriva da API un valore allore ti restitusce tutti dottori
        if (isset($data['avg_vote'])) {
            $doctors->havingRaw('CAST(IFNULL(AVG(reviews.vote_id), 0) AS UNSIGNED) >= ?', [$data['avg_vote']]);
        }
        ;

        //  //Prendiamo i dottori che non hanno sponsorship o quelli che l`hanno scaduto
        //  $doctors->whereDoesntHave('sponsorships')->orWhereHas('sponsorships', function (Builder $query) use ($current_time) {
        //     $query->where('end_date', '<', $current_time);
        // });

        //Creamo la variabile per uttillizzarla nella risposta ad API
        $results = $doctors->get();

        /**
         * 
         *             DOCTORI CON SPONSORIZAZZIONE
         * 
         */

        //Prendiamo solo i dottori che non hanno sponsorships scaduto
        $doctors_sponsorships = Doctor::whereHas('sponsorships', function (Builder $query) use ($current_time) {
            $query->where('end_date', '>', $current_time);
        })->with('specializations', 'reviews', 'user', 'sponsorships')->withCount('reviews');

        // //Prepariamo collection di dottori
        // $doctors_sponsorships = Doctor::with('specializations', 'reviews', 'user', 'sponsorships')
        //     ->withCount('reviews');

        //Filtriamo il resultato dei dottori con ASC o DESC uttilizando il parametro arrivato da API
        if (isset($data['order'])) {
            $doctors_sponsorships->orderBy('reviews_count', $data['order']);
        }
        ;

        //Filtriamo il resultato dei dottori in base a specializzazione scelta
        if (isset($data['specialization_id'])) {
            //Assegnamo a una nuova variabile il valore della specializzazione da cercare
            $specialization_id = $data['specialization_id'];

            //Cerchiamo i dottori che hanno una specifica specializzazione 
            $doctors_sponsorships->whereHAs('specializations', function (Builder $query) use ($specialization_id) {
                $query->where('specialization_id', $specialization_id);
            });
        }
        ;

        //Colleghiamo tabella doctors con review e raggruppiamo per id dottore 
        $doctors_sponsorships->select('doctors.*', DB::raw('IFNULL(CAST(AVG(reviews.vote_id) AS UNSIGNED), 0) as media_voti'))
            ->leftJoin('reviews', 'doctors.id', '=', 'reviews.doctor_id')
            ->groupBy('doctors.id')
            ->withCount('reviews');

        //Se non arriva da API un valore allore ti restitusce tutti dottori
        if (isset($data['avg_vote'])) {
            $doctors_sponsorships->havingRaw('CAST(IFNULL(AVG(reviews.vote_id), 0) AS UNSIGNED) >= ?', [$data['avg_vote']]);
        }
        ;

        //Creamo la variabile per uttillizzarla nella risposta ad API
        $doctors_sponsorships = $doctors_sponsorships->get();

        // Creiamo un array di id dei dottori in $doctors_sponsorship
        $doctorsSponsorshipIds = collect($doctors_sponsorships)->pluck('id');

        // Filtriamo gli elementi in $results escludendo quelli presenti in $doctorsSponsorshipIds
        $results = collect($results)->reject(function ($result) use ($doctorsSponsorshipIds) {
            return in_array($result['id'], $doctorsSponsorshipIds->toArray());
        })->values();

        return response()->json([
            'status' => true,
            'results' => $results,
            'doctors_sponsorships' => $doctors_sponsorships,
        ]);
    }

    public function show($id)
    {

        // $doctor = Doctor::with('specializations', 'reviews', 'user', 'sponsorships')->where('id', $id)->first();

        $doctor = Doctor::with([
            'specializations',
            'reviews' => function ($query) {
                $query->with('vote'); // includi la relazione 'votes' dentro 'reviews'
            },
            'user',
            'sponsorships'
        ])->where('id', $id)->first();

        $current_time = Carbon::now();

        // $doctor = Doctor::with('specializations', 'reviews', 'user', 'sponsorships')->where('id', $id)->first();

        $doctor = Doctor::with([
            'specializations',
            'reviews' => function ($query) {
                $query->orderBy('created_at', 'desc')->with('vote'); // includi la relazione 'votes' dentro 'reviews'
            },
            'user',
            'sponsorships'
        ])->where('id', $id)->first();

        $purchase_end_dates = $doctor->sponsorships()->withPivot('end_date')->get();
        foreach ($purchase_end_dates as $purchase_end_date) {
            $end_date = $purchase_end_date->pivot->end_date;
        }

        if ($current_time <= $end_date) {
            return response()->json([
                'results' => $doctor,
                'is_sponsored' => true,
                'success' => true,
            ]);
        } else {
            return response()->json([
                'results' => $doctor,
                'is_sponsored' => false,
                'success' => true,
            ]);
        }
    }
}
