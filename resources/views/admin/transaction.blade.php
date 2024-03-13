@extends('layouts.app')

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="d-flex  flex-column align-items-center">
                    <div class="icon">
                        <img src="{{ Vite::asset('resources/img/' . $icon . '.svg') }}" alt="">
                    </div>
                    <div class="d-flex flex-column">
                        <h1>{{ $header }}</h1>
                        <p>{{ $message }}</p>
                    </div>
                    <div>
                        <a class="btn btn-cust" href="{{ route('admin.dashboard.index') }}">Torna alla Dashboard</a>
                    </div>
                </div>


            </div>
            <div class="col-12 col-lg-6">
                @if (in_array($transaction->status, $transactionSuccessStatuses))
                    <div class="green-card p-3">
                        <h3>Dati di pagamento</h3>
                        <p><strong>Carta</strong>:
                            {{ $transaction->creditCardDetails->bin . '** **** ' . $transaction->creditCardDetails->last4 }}
                        </p>
                        <p><strong>Scadenza</strong>: {{ $transaction->creditCardDetails->expirationDate }}</p>
                        <p><strong>Nome intestatario</strong>: {{ $doctor->user->name . ' ' . $doctor->user->surname }}</p>
                    </div>
                @else
                    <div class="red-card p-3">
                        <h3>Dati di pagamento</h3>
                        <p><strong>Carta</strong>:
                            {{ $transaction->creditCardDetails->bin . '** **** ' . $transaction->creditCardDetails->last4 }}
                        </p>
                        <p><strong>Scadenza</strong>: {{ $transaction->creditCardDetails->expirationDate }}</p>
                        <p><strong>Nome intestatario</strong>: {{ $doctor->user->name . ' ' . $doctor->user->surname }}</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
