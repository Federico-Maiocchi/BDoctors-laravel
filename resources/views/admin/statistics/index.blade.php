@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center row-gap-4 py-5">
            <div class="col-12 d-flex gap-3 align-items-center justify-content-center">
                <h1>Le tue statistiche</h1>
                <select id="year" name="year">
                    @foreach ($messages_years as $year)
                        <option @if ($year == $selected_year) selected @endif value="{{ $year }}">
                            {{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <h6>Nel {{ $selected_year }} hai ricevuto {{ $selected_year_messages_n }} messaggi e
                    {{ $selected_year_reviews_n }} recensioni</h6>
            </div>

            <div class="col-12 col-lg-9">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-12 col-lg-6">
                <canvas id="mySecondChart"></canvas>
            </div>
            <div class="col-12 col-lg-6">
                <canvas id="myThirdChart"></canvas>
            </div>
        </div>
    </div>
    {{-- <form method="get" action="{{ route('admin.statistics.index') }}"> --}}
    {{-- @csrf --}}

    {{-- <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option> --}}
    {{-- </select> --}}
    {{-- <button type="submit">Seleziona</button> --}}
    {{-- </form> --}}
    {{-- @if (isset($selected_year))
                    <p>Nel {{ $selected_year }} hai ricevuto {{ $selected_year_messages_n }} messaggi e
                        {{ $selected_year_reviews_n }} recensioni</p>
                    <h4>Messaggi ricevute per mese nel {{ $selected_year }}</h4>
                    @foreach ($messages_per_month as $key => $messages_n)
                        <p><strong>{{ $key }}</strong>: {{ $messages_n }}</p>
                    @endforeach
                    <h4>Recensioni ricevute per mese nel {{ $selected_year }}</h4>
                    @foreach ($reviews_per_month as $key => $reviews_n)
                        <p><strong>{{ $key }}</strong>: {{ $reviews_n }}</p>
                    @endforeach
                @else
                    <p>Seleziona un anno dal menu a tendina</p>
                @endif
                <p>Media totale delle recensioni: {{ $reviews_average }}</p>
            </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //  genero un array PHP $messages_per_month, con il numero di messaggi per ogni mese dell'anno selezionato. 
        // viene convertito in formato JSON e inserito nella variabile messageData.
        const messageData = {!! json_encode($messages_per_month) !!}

        // event listener al html select id year. Quando viene cambiata l'anno, esegue callback. aggiorna l'URL della pagina con il valore selezionato dall'utente. 
        // reindirizza l'utente alla pagina delle statistiche con l'anno scelto.
        // ogni volta che l'utente seleziona un nuovo anno aggiornata dinamicamente.
        const selectYear = document.getElementById('year');
        selectYear.addEventListener('change', function() {
            window.location.href = "{{ route('admin.statistics', ['year' => ':year']) }}"
                .replace(':year', selectYear.value)
        })
        const ctx = document.getElementById('myChart');
        const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre',
            'Ottobre', 'Novembre', 'Dicembre'
        ];
        // grafico messaggi 
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Messaggi per Mese',
                    data: messageData,
                    borderWidth: 2,
                    backgroundColor: 'rgba(115, 183, 96, 0.3)',
                    borderColor: 'rgb(115, 183, 96)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // grafico recensioni
        const reviewData = {!! json_encode($reviews_per_month) !!}
        const ctx2 = document.getElementById('mySecondChart');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Recensioni per Mese',
                    data: reviewData,
                    borderWidth: 2,
                    backgroundColor: 'rgba(152, 208, 246, 0.5)',
                    borderColor: 'rgb(152, 208, 246)'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        // grafico media 
        const avgReviewData = {!! json_encode($avg_reviews_per_month) !!}
        const ctx3 = document.getElementById('myThirdChart').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Media voti per mese',
                    data: avgReviewData,
                    borderWidth: 2,
                    // cambio colore delle barre in base la media del voto 
                    backgroundColor: function(context) {
                        const value = context.dataset.data[context.dataIndex];
                        if (value >= 4 && value <= 5) {
                            return 'rgba(115, 183, 96, 0.5)';
                        } else if (value >= 3 && value < 4) {
                            return 'rgba(245, 245, 69, 0.5)';
                        } else if (value >= 2 && value < 3) {
                            return 'rgba(244, 176, 28, 0.5)';
                        } else if (value >= 1 && value < 2) {
                            return 'rgba(244, 33, 33, 0.5)'
                        }
                    },
                    borderColor: function(context) {
                        const value = context.dataset.data[context.dataIndex];
                        if (value >= 4 && value <= 5) {
                            return 'rgb(115, 183, 96)';
                        } else if (value >= 3 && value < 4) {
                            return 'rgb(245, 245, 69)';
                        } else if (value >= 2 && value < 3) {
                            return 'rgb(244, 176, 28)';
                        } else if (value >= 1 && value < 2) {
                            return 'rgb(252, 31, 31)'
                        }
                    },
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    </script>
@endsection
