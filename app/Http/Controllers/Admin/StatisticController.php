<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $selected_year)
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();
        // Recupera il dottore associato all'utente loggato.
        // Restituisce un array di lunghezza 1 (relazione one-to-one)
        $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
        $doctor = $doctors[0];
        // Recupera i messaggi associati al dottore loggato
        $messages = Message::where('doctor_id', '=', $doctor->id)->get();
        //Recupera le recensioni associate al dottore loggato
        $reviews = Review::where('doctor_id', '=', $doctor->id)->get();

        // seleziona l'anno dalla colonna created_at elimina i duplicati distinct(), ordinati orderBy(), recuperati come un array pluck().
        $messages_years = Message::selectRaw('YEAR(created_at) as year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();

        $messages_per_month = [];
        // itera i dodici mesi dell'anno calcola il numero di messaggi, whereYear() e whereMonth() 
        // per filtrare i messaggi in base all'anno e al mese correnti
        for ($i = 1; $i <= 12; $i++) {
            $messages_per_month[$i - 1] = Message::whereYear('created_at', $selected_year)->whereMonth('created_at', $i)->count();
        }
        // numero totale di messaggi presenti nell'anno selezionato, whereYear() per filtrare i messaggi solo per l'anno selezionato. count() per contare il numero di risultati.
        $selected_year_messages_n = Message::whereYear('created_at', $selected_year)->count();
        
        // seleziona l'anno dalla colonna created_at elimina i duplicati distinct(), ordinati orderBy(), recuperati come un array pluck().
        $reviews_year = Review::selectRaw('YEAR(created_at) as year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();

        $reviews_per_month = [];
        // itera i dodici mesi dell'anno calcola il numero recensioni, whereYear() e whereMonth() 
        // per filtrare i messaggi in base all'anno e al mese correnti
        for ($i = 1; $i <= 12; $i++) {
            $reviews_per_month[$i - 1] = Review::whereYear('created_at', $selected_year)->whereMonth('created_at', $i)->count();
        }

        // calcolo la media dei voti avg('vote_id'), che restituisce il valore medio di vote_id delle recensioni in quel mese.
        $avg_reviews_per_month = [];
        for ($i = 1; $i <= 12; $i++) {
            $avg_reviews_per_month[$i - 1] = Review::whereYear('created_at', $selected_year)->whereMonth('created_at', $i)->avg('vote_id');
        }
        // conta il numero totale di recensioni nell'anno selezionato whereYear()
        $selected_year_reviews_n = Review::whereYear('created_at', $selected_year)->count();
        
        return view('admin.statistics.index', compact('avg_reviews_per_month', 'doctor', 'selected_year', 'selected_year_messages_n', 'selected_year_reviews_n', 'reviews_per_month', 'messages_per_month', 'messages_years'));
    }
        // Recupera l'informazione dell'anno selezionato dal form
        // $selected_year = $request->input('year');
        // Dichiariamo un array vuoto all'interno del quale, attraverso un controllo, pushamo tutti i messaggi scritti nello stesso anno del $selected_year

        // $selected_year_messages = [];
        // $messages_per_month = [
        //     'January' => 0,
        //     'February' => 0,
        //     'March' => 0,
        //     'April' => 0,
        //     'May' => 0,
        //     'June' => 0,
        //     'July' => 0,
        //     'August' => 0,
        //     'September' => 0,
        //     'October' => 0,
        //     'November' => 0,
        //     'December' => 0,
        // ];
        // foreach ($messages as $message) {
        //     $message_year = intval(date('Y', strtotime($message->created_at)));
        //     $message_month = date('F', strtotime($message->created_at));
        //     if ($message_year == $selected_year) {
        //         $messages_per_month[$message_month]++;
        //         array_push($selected_year_messages, $message->id);
        //     }
        // }
        // Dichiariamo un array vuoto all'interno del quale, attraverso un controllo, pushamo tutte le recensioni scritti nello stesso anno del $selected_year
        // $selected_year_reviews = [];
        // $reviews_per_month = [
        //     'January' => 0,
        //     'February' => 0,
        //     'March' => 0,
        //     'April' => 0,
        //     'May' => 0,
        //     'June' => 0,
        //     'July' => 0,
        //     'August' => 0,
        //     'September' => 0,
        //     'October' => 0,
        //     'November' => 0,
        //     'December' => 0,
        // ];
        // foreach ($reviews as $review) {
        //     $review_year = intval(date('Y', strtotime($review->created_at)));
        //     $review_month = date('F', strtotime($review->created_at));
        //     if ($review_year == $selected_year) {
        //         $reviews_per_month[$review_month]++;
        //         array_push($selected_year_reviews, $review->id);
        //     }
        // }

        //contiamo il numero di messaggi e recensioni all'interno dell'array
        // $selected_year_messages_n = count($selected_year_messages);
        // $selected_year_reviews_n = count($selected_year_reviews);
        //Contiamo il numero di recensioni associate al dottore
        // $reviews_n = count($reviews);
        // $reviews_total_votes = 0;
        // Cicliamo le reviews associate al dottore per sommare il totale dei voti
        // foreach ($reviews as $review) {
        //     $reviews_total_votes += $review->vote->value;
        // }
        // Calcoliamo la media
        // $reviews_average = $reviews_total_votes / $reviews_n;
        // Restituisce la vista dell'elenco dei messaggi per l'amministratore,
        // passando l'array di messaggi come variabile compatta
       

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
