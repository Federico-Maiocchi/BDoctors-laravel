@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-6">
                <div class="green-card">
                    <div class="card-body">
                        <p><strong>Nome:</strong> {{ $review->name }}</p>
                        <div class="d-flex gap-4">
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}</h6>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $review->created_at->format('H:i') }}</h6>
                        </div>
                        <p><strong>Messaggio:</strong> {{ $review->message }}</p>
                        <p><strong>Voto Recensione:</strong> {{ $review->vote->name }}, {{ $review->vote->value }}</p>
                        <div class="d-flex gap-2 justify-content-between">
                            <a href="{{ route('admin.reviews.index') }}">
                                <button type="button" class="btn-cust">Chiudi</button>
                            </a>
                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                                @csrf
                                @method('delete')
                            </form>
                             {{-- aggiunto btn softdelete  --}}
                            <button type="submit" class="btn-cust-red delete-btn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- aggiunto form conferma  --}}
        <div id="bgForm" class="bg-form ">
            <div class="d-flex align-items-center gap-3 delete-form">
                <h4 class="text-light">Vuoi davvero eliminare questa recensione?</h4>
                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-lg">Si</button>
                    <button id="noBtn" class="btn btn-primary btn-lg">No</button>
                </form>
                
            </div>
        </div>
    </div>

    <script>
        const deleteButton = document.querySelector('.delete-btn');
    const noButton = document.getElementById('noBtn');
    const form = document.getElementById('bgForm');

    deleteButton.addEventListener('click', function() {
        form.classList.add('active');
    });

    noButton.addEventListener('click', function() {
        form.classList.remove('active');
    });
    </script>
@endsection
