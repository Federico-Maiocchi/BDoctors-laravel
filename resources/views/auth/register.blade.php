@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="green-card">
                    <h5 class="card-header mb-4">{{ __('Register') }}</h5>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" onsubmit="return validatePassword()">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name*') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>
                                    <span id="name-error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong>Inserisci il nome.</strong>
                                    </span>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="surname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Surname*') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" autocomplete="surname" autofocus>
                                    <span id="surname-error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong>Inserisci il cognome.</strong>
                                    </span>
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">
                                        <span id="email-error" class="invalid-feedback" role="alert" style="display: none;">
                                            <strong>Inserisci l'email.</strong>
                                        </span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    <span id="password-length-error" class="invalid-feedback" role="alert"
                                        style="display: none;">
                                        <strong>La password deve essere lunga almeno 8 caratteri.</strong>
                                    </span>
                                    <span id="password-mismatch-error" class="invalid-feedback" role="alert"
                                        style="display: none;">
                                        <strong>Le password non corrispondono.</strong>
                                    </span>
                                    <span id="password-combined-error" class="invalid-feedback" role="alert"
                                        style="display: none;">
                                        <strong>La password è troppo corta e non corrisponde.</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password*') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validatePassword() {
            let email = document.getElementById('email').value;
            let surname = document.getElementById('surname').value;
            let name = document.getElementById('name').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('password-confirm').value;
            let passwordLengthError = document.getElementById('password-length-error');
            let passwordMismatchError = document.getElementById('password-mismatch-error');
            let passwordCombinedError = document.getElementById('password-combined-error');
            let nameError = document.getElementById('name-error');
            let surnameError = document.getElementById('surname-error');
            let emailError = document.getElementById('email-error');

            passwordLengthError.style.display = 'none';
            passwordMismatchError.style.display = 'none';
            passwordCombinedError.style.display = 'none';
            nameError.style.display = 'none';
            surnameError.style.display = 'none';
            emailError.style.display = 'none';


            if (name === '') {
                nameError.style.display = 'block';
                return false;
            }

            if (surname === '') {
                surnameError.style.display = 'block';
                return false;
            }

            if (email === '') {
                emailError.style.display = 'block';
                return false;
            }

            if (password.length < 8 && password !== confirmPassword) {
                passwordCombinedError.style.display = 'block';
                return false;
            }

            if (password.length < 8) {
                passwordLengthError.style.display = 'block';
                return false;
            }

            if (password !== confirmPassword) {
                passwordMismatchError.style.display = 'block';
                return false;
            }

            return true;
        }
    </script>
@endsection
