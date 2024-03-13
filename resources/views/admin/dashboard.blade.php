@extends('layouts.app')

@section('content')
    <div class="container pb-3">
        {{-- evita messaggio errore in caso $doctor non sia definito --}}
        @if (isset($doctor))
            <div class="row">
                <div class="text d-flex gap-3 align-items-center">
                    <h1 class="my-md-2">
                        Dott. {{ $doctor->user->name }} {{ $doctor->user->surname }}
                    </h1>
                    @if ($end_date > $current_date)
                        <i class="fa-solid fa-crown crown fs-3"></i>
                    @endif
                </div>


                @if ($end_date > $current_date)
                    <div class="d-block d-md-flex align-items-center gap-3 py-md-2">
                        <span><a class="btn-cust-yellow" href="{{ route('admin.sponsorship.index') }}">Gestisci
                                abbonamento</a></span>
                        <h4>Sponsorizzato fino al {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }} ore:
                            {{ \Carbon\Carbon::parse($end_date)->format('H:i') }} </h4>
                    </div>
                @else
                    <div class="d-block d-md-flex align-items-center gap-3 py-md-2">
                        <span><a class=" btn-cust-yellow " href="{{ route('admin.sponsorship.index') }}">Scegli
                                abbonamento</a></span>
                        <h4> Non sei ancora abbonato </h4>
                    </div>
                @endif

                <div class="col-lg-4">
                    <div class="green-card mt-5 mt-lg-2">
                        <div class="row">
                            <div class="col-md-6 col-lg-12 mb-3">
                                <figure>
                                    <img src="{{ asset($doctor->photo) }}" alt=""
                                        class="h-100 rounded img-thumbnails">
                                </figure>
                                <p><strong>Indirizzo:</strong> {{ $doctor->address }}</p>
                                <p><strong>Numero di teleofono:</strong> {{ $doctor->phone_number }}</p>


                                <a class="btn-cust" href="{{ asset('pdf/cv9.pdf') }}" target="_blank">Apri il curriculum</a>

                                {{-- <p>Data inizio: {{ $start_date }}</p> --}}
                            </div>
                            <div class="col-md-6 col-lg-12 align-self-md-end">
                                <p class="mb-1"><strong>Le tue specializzazioni:</strong></p>
                                <ul>
                                    @foreach ($doctor->specializations as $specialization)
                                        <li>{{ $specialization->name }}</li>
                                    @endforeach
                                </ul>
                                <p><strong>Le tue prestazioni:</strong> {{ $doctor->medical_services }}</p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-cust">Modifica</a>
                                    {{-- <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare il profilo?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" value="Elimina profilo">Elimina</button>
                            </form> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="green-card mt-5 mt-lg-2">
                        <h3>Messaggi</h3>
                        <a class="btn-cust dashboard-link" href="{{ route('admin.messages.index') }}">Visualizza tutti</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col" class="d-none d-lg-block">Indirizzo email</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Orario</th>
                                    <th scope="col">Apri</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $key => $message)
                                    <tr>
                                        <td scope="row">{{ $message->name }} {{ $message->surname }}</td>
                                        <td class="d-none d-lg-block">{{ $message->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td>{{ $message->created_at->format('H:i') }}</td>
                                        <td><a href="{{ route('admin.messages.show', $message) }}"> <i
                                                    class="fa-solid fa-envelope"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="green-card mt-5 mt-lg-2">
                        <h3>Recensioni</h3>
                        <a class="btn-cust dashboard-link" href="{{ route('admin.reviews.index') }}">Visualizza tutte</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col" class="d-none d-lg-block">Messaggio</th>
                                    <th scope="col">Voto</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Orario</th>
                                    <th scope="col">Apri</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $key => $review)
                                    <tr>
                                        <td scope="row">{{ $review->name }}</td>
                                        <td class="d-none d-lg-block">{{ $review->message }}</td>

                                        <td>{{ $review->vote->value }}/5</td>
                                        <td>{{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td>{{ $review->created_at->format('H:i') }}</td>
                                        <td><a href="{{ route('admin.reviews.show', $review) }}"> <i
                                                    class="fa-solid fa-star"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
