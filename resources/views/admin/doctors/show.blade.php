@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dott. {{ $doctor->user->name }} {{ $doctor->user->surname }}</h1>
        <img style="width: 200px; height: 200px" src="{{ asset($doctor->photo) }}" alt="">
        <p>{{ $doctor->address }}</p>
        <p>{{ $doctor->phone_number }}</p>
        <ul>
            @foreach ($doctor->specializations as $specialization)
                <li>{{ $specialization->name }}</li>
            @endforeach
        </ul>
        <p>{{ $doctor->medical_services }}</p>
        <div class="d-flex gap-2">
            <a href="{{route('admin.doctors.edit', $doctor) }}" class="btn btn-primary">Modifica</a>
            <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" onsubmit="return confirm('Sei sicuro di voler eliminare il profilo?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit" value="Elimina profilo">Elimina</button>
            </form>
        </div>
        
    </div>
@endsection