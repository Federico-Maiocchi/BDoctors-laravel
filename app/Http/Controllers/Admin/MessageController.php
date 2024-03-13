<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();


        // Se utente logato non puoi visualizzare i messaggi
        if (!$logged_user->doctor) {
            return redirect()->route('admin.dashboard.index');
        }
        // altrimenti visualizza i messaggi associati al dottore
        else {
            // Recupera il dottore associato all'utente loggato.
            // Restituisce un array di lunghezza 1 (relazione one-to-one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            $doctor = $doctors[0];
            // Recupera i messaggi associati al dottore loggato
            $messages = Message::where('doctor_id', '=', $doctor->id)
            ->orderBy('created_at', 'desc')
            ->get();
            // Restituisce la vista dell'elenco dei messaggi per l'amministratore,
            // passando l'array di messaggi come variabile compatta
            return view('admin.messages.index', compact('messages', 'doctor'));
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
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        // Ottieni l'utente attualmente loggato
        $logged_user = Auth::user();

        if (!$logged_user->doctor) {
            return redirect()->route('admin.dashboard.index');
        }
        // altrimenti visualizza il messaggi associati al dottore
        else {

            // Recupera il dottore associato all'utente loggato.
            // Restituisce un array di lunghezza 1 (relazione one-to-one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            $doctor = $doctors[0];

            // Verifica se il dottore loggato è il destinatario del messaggio
            if ($doctor->id == $message->doctor_id) {
                // Se il dottore loggato è il destinatario, visualizza la vista del singolo messaggio
                return view('admin.messages.show', compact('message', 'doctor'));
            } else {
                // Se il dottore loggato non è il destinatario, visualizza una vista di errore
                return view('errors.error');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    public function restore($message_id)
    {
        // recupera il messaggio, incluso se è stato eliminato.
        $message = Message::withTrashed()->where('id', $message_id)->first();

        // verifica se il messaggio esiste.
        if (!isset($message)) {
            //altrimenti restituisce un errore 404.
            abort(404);
        }

        if ($message->trashed()) {
            $message->restore();
        }

        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($message_id)
    {

        // recupera il messaggio
        $message = Message::withTrashed()->where('id', $message_id)->first();
        if (!isset($message)) {
            abort(404);
        }

        if ($message->trashed()) {
            $message->forceDelete();
        } else {
            $message->delete();
        }
        // torna alla pagina dell'indice dei messaggi.
        return redirect()->route('admin.messages.index');
    }
}
