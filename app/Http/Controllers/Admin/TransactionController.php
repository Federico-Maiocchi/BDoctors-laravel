<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Braintree;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logged_user = Auth::user();

        if ($logged_user->doctor) {
            // restituisce il dottore collegato allo user loggato 
            // resituisce array di lunghezza 1 (relazione one to one)
            $doctors = Doctor::where('user_id', '=', $logged_user->id)->get();
            $doctor = $doctors[0];

            $id = $request->input('id');

            $transaction = $request;

            if (isset($id)) {

                $gateway = new Braintree\Gateway([
                    'environment' => config('services.braintree.environment'),
                    'merchantId' => config('services.braintree.merchantId'),
                    'publicKey' => config('services.braintree.publicKey'),
                    'privateKey' => config('services.braintree.privateKey')
                ]);

                $transaction = $gateway->transaction()->find($id);

                $transactionSuccessStatuses = [
                    Braintree\Transaction::AUTHORIZED,
                    Braintree\Transaction::AUTHORIZING,
                    Braintree\Transaction::SETTLED,
                    Braintree\Transaction::SETTLING,
                    Braintree\Transaction::SETTLEMENT_CONFIRMED,
                    Braintree\Transaction::SETTLEMENT_PENDING,
                    Braintree\Transaction::SUBMITTED_FOR_SETTLEMENT
                ];

                if (in_array($transaction->status, $transactionSuccessStatuses)) {
                    $header = "Transazione approvata!";
                    $icon = "success";
                    $message = "La tua transazione di prova è stata elaborata con successo.";

                } else {
                    $header = "Transazione fallitta";
                    $icon = "fail";
                    $message = "La tua transazione di prova ha uno stato di " . $transaction->status . ". Riprova più tardi.";
                }
            }

            return view('admin.transaction', compact('header', 'icon', 'message', 'transaction', 'transactionSuccessStatuses', 'doctor'));
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
