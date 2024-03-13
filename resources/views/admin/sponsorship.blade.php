@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pt-4  d-flex justify-content-center align-items-center">
            <p class="sponsorship-description">Abbonati ora per ottenere visibilità immediata e primeggiare sugli altri! Con
                il nostro abbonamento, il tuo profilo sarà mostrato in primo piano <i class="fa-solid fa-crown"></i></p>
        </div>
        <div class=" d-block d-md-flex justify-content-between align-items-center h-100 gap-4">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-12 col-md-4 pt-3">
                    <div class="card-cust h-100">
                        <div class="card-top h-100 fs-3">
                            @if ($sponsorship->duration / 24 === 1)
                                <p>Abbonamento da {{ $sponsorship->duration / 24 }} giorno</p>
                            @else
                                <p>Abbonamento da {{ $sponsorship->duration / 24 }} giorni</p>
                            @endif
                        </div>
                        <div class="card-bottom">
                            <div class="d-flex justify-content-center fs-5">
                                <p>Questo abbonamento dura {{ $sponsorship->duration }}h</p>
                            </div>
                            <div class="d-flex justify-content-center fs-4">
                                <p><strong>{{ $sponsorship->price }}&euro;</strong></p>
                            </div>
                            
                            <div class="d-flex justify-content-center h-100 ">
                                <a class="btn btn-cust" href="{{ route('admin.payments.index', ['sponsorship_id' => $sponsorship->id]) }}">
                                    Abbonati ora 
                                    <i class="fa-solid fa-crown"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

           
        </div>
    </div>
    <div class="d-flex justify-content-center pt-5">
        <p>*Ogni abbonamento scade in automatico</p>
    </div>
    </div>
@endsection
