@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="green-card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{ $message->name }} {{ $message->surname }}</h4>
                        <div class="d-flex gap-4">
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                {{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y') }}</h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $message->created_at->format('H:i') }}</h6>
                        </div>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $message->phone_number }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $message->email }}</h6>
                        <p class="card-text">{{ $message->message }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.messages.index') }}">
                                <button type="button" class="btn-cust">Chiudi</button>
                            </a>
                            {{-- aggiunto btn softdelete  --}}
                            <button type="submit" id="myBtn" class="btn-cust-red">Elimina</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- aggiunto form conferma  --}}
    <div id="bgForm" class="bg-form">
        <div class="d-flex align-items-center gap-3 delete-form">
            <h4 class="text-light">Vuoi davvero eliminare questo messaggio?</h4>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-lg">Si</button>
            </form>
            <button id="noBtn" class="btn btn-primary btn-lg">No</button>
        </div>
    </div>

    <script>
        deleteDomEl = document.getElementById('myBtn');
        noDomEl = document.getElementById('noBtn');
        formDomEl = document.getElementById('bgForm');

        deleteDomEl.addEventListener('click', function() {
            formDomEl.classList.add('active')
        })

        noDomEl.addEventListener('click', function() {
            formDomEl.classList.remove('active')
        })
    </script>
@endsection
