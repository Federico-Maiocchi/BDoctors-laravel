@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dottori</h1>
        <div class="card my-2">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">surname</th>
                        <th scope="col">address</th>
                        <th scope="col">specialization</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                    <tr>
                        <th scope="row"><a href="{{ route('admin.doctors.show', $doctor) }}">{{ $doctor->id }}</a></th>
                        <td>{{ $doctor->user->name }}</td>
                        <td>{{ $doctor->user->surname }}</td>
                        <td>{{ $doctor->address }}</td>
                        <td>
                            @foreach ($doctor->specializations as $specialization)
                            {{ $specialization->name }}                                
                            @endforeach
                        </td>

                        </th>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection