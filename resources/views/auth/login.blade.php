@extends('layouts.simple')

@section('content')
{{-- <div class="container"> --}}
   <!-- Page Content -->
<div class="bg-image" style="background-image: url({{asset('/media/photos/background.jpg')}});">
    <div class="row mx-0 bg-black-op">
        <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
            <div class="p-30 invisible" data-toggle="appear">
                <p class="font-size-h3 font-w600 text-white">

                </p>
                <p class="font-italic text-white-op">
                    Copyright &copy; <span class="js-year-copy"></span>
                </p>
            </div>
        </div>
        <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">

            <div class="content content-full">
                <!-- Header -->

                <div class="px-30 py-30 text-center" >
                    <img class="col-12 rounded-circle" src="{{asset('/media/photos/torogym.png')}}" >
                </div>

                {{-- <div class="px-30 py-30 text-center">
                    <a class="link-effect font-w700 " href="index.php">
                        {{-- <i class="si si-fire"></i> --}}
                        {{-- <span class="font-size-h1 text-primary-dark">{{env('APP_FIRST_NAME')}} </span><span class="font-size-h1">{{env('APP_SECOND_NAME')}}</span> --}}
                    {{-- </a> --}}
                    {{-- <h1 class="h4 font-w700 text-muted mt-30 mb-10 text-center">.:Bienvenido a ContactGen:.</h1> --}}
                    {{-- <h2 class="h3 font-w400 text-muted mb-0 text-center">Inicie sesión</h2> --}}
                {{-- </div> --}}
                <!-- END Header -->


                    <br>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Clave') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {{-- <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label> --}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
