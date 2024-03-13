@extends('layouts.app')

@section('content')
<div class="pt-4">
    <div class="container ">
        <div class="green-card row justify-content-center pt-5">
            <div class="col-auto">
                {{-- @if($logged_user)
                        <h1>Benvenuto {{ $logged_user->name}} {{ $logged_user->surname}} </h1>
                @else
                <h1>Benvenuto a BDoctors</h1>
                <h3>Registra il tuo nuovo account o fai Login</h3>
                @endif --}}
                {{-- <h1> Prova pagamento</h1> --}}
    
                @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                @endif
    
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
    
                <h3>Procedi con l'acquisto del seguente abbonamento</h3>
             
                <form method="POST" id="payment-form" action="{{ route('admin.payments.store', ['doctor_id' => $doctor->id,'sponsorship' => $sponsorship]) }}">
                    @csrf
                    <section>
                        <label for="amount">
                            <span class="input-label"></span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" hidden name="amount" type="tel" min="1" placeholder="Amount" value="10">
                                <div class="fs-5">Prezzo abbonamento: <div class="fw-bold fs-3 p-3">{{ $price }}&euro;</div></div>
                            {{-- <div>
                                {{$sponsorship }}
                            </div> --}}
                        </label>
    
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>
    
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="btn-cust fs-4" type="submit"><span>Acquista</span></button>
                </form>
            </div>
        </div>
    </div>
</div>



{{-- JS CODE --}}
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    var sponsorshipPrice = {{ $price }};

    braintree.dropin.create({
        authorization: client_token
        , selector: '#bt-dropin'
        , paypal: {
            flow: 'vault'
        }
    }, function(createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            instance.requestPaymentMethod(function(err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                document.querySelector('#amount').value = sponsorshipPrice;

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });

</script>
@endsection
