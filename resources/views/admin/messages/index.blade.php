@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>I miei messaggi</h1>
                <h5>Hai {{ count($messages) }} messaggi</h5>
                <div class="green-card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="d-none d-lg-block" scope="col">Indirizzo mail</th>
                                <th scope="col">Data</th>
                                <th scope="col">Orario</th>
                                <th scope="col">Apri</th>
                                <th class="d-none d-lg-block" scope="col">Elimina</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $key => $message)
                                <tr>
                                    <td>{{ $message->name }} {{ $message->surname }}</td>
                                    <td class="d-none d-lg-block">{{ $message->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y') }}
                                    </td>
                                    <td>{{ $message->created_at->format('H:i') }}</td>
                                    <td>
                                        <a class="ms-3" href="{{ route('admin.messages.show', $message) }}"><i
                                                class="fa-solid fa-envelope"></i></a>
                                        {{-- aggiunto btn elimina soft delte  --}}

                                    </td>
                                    <td class="d-none d-lg-block">
                                        <a class="myTrash ms-3"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                    {{-- aggiunto form conferma  --}}
                                    <div class="bg-form bgForm">
                                        <div class="d-flex align-items-center gap-3 delete-form">
                                            <h4 class="text-light">Vuoi davvero eliminare questo messaggio?</h4>
                                            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-lg">Si</button>
                                            </form>
                                            <button class="btn btn-primary btn-lg noBtn">No</button>
                                        </div>
                                    </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        deleteDomEl = document.querySelectorAll('.myTrash');
        noDomEl = document.querySelectorAll('.noBtn');
        formDomEl = document.querySelectorAll('.bgForm');

        // aggiunto un event listener a ciascun pulsante "Elimina"
        for (let i = 0; i < deleteDomEl.length; i++) {
            deleteDomEl[i].addEventListener('click', function() {
                console.log('ciao')
                formDomEl[i].classList.add('active')
            })
        }
        // aggiunto un event listener a ciascun pulsante "No"
        for (let i = 0; i < deleteDomEl.length; i++) {
            noDomEl[i].addEventListener('click', function() {
                formDomEl[i].classList.remove('active')
            })
        }
    </script>
@endsection
