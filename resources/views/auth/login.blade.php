@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-image: url('/img/home_casa.jpg'); background-size: cover; background-position: center; height: 100vh;">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="card" style="margin-top: 0px; background-color: rgba(255, 255, 255, 0.8);"> <!-- Margen superior aumentado y transparencia -->
                <div class="row g-0">
                    <!-- Primera columna con la imagen -->
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <img src="img/HOMEpng.png" alt="Home Image" class="img-fluid p-4">
                    </div>

                    <!-- Segunda columna con el formulario de login -->
                    <div class="col-md-6">
                        <div class="card-body">
                            <h3 class="card-header text-center" style="background-color: transparent;">{{ __('ACCESO') }}</h3> <!-- Título transparente -->

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3 mt-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
