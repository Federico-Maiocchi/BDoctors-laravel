@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.doctors.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="curriculum" class="form-label">Curriculum (opzionale)</label>
                <input type="file" class="form-control" id="curriculum" name="curriculum" accept=".pdf" value="{{ old('curriculum')}}">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Immagine (opzionale)</label>
                <input type="file" class="form-control" id="photo" name="photo" accept=".jpeg,.png" value="{{ old('photo') }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo*</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Telefono*</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
            </div>
            <div class="mb-3">
                <label for="medical_services" class="form-label">Prestazioni*</label>
                <input type="text" class="form-control" id="medical_services" name="medical_services" value="{{ old('medical_services') }}">
            </div>
            <div class="mb-3">
                <p>Seleziona le tue specializzazioni*</p>
                @foreach($specializations as $specialization)
                <input type="checkbox" @checked(in_array($specialization->id, old('specializations', []))) id="{{ $specialization->name }}" name="specializations[]" value="{{ $specialization->id }}">
                    <label for="{{ $specialization->name }}">{{ $specialization->name }}</label>
                @endforeach
            </div>
            <input type="submit" value="Crea Profilo">
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection