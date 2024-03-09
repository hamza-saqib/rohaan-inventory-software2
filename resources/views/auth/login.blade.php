{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
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

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{config('app.name')}} | {{ __('Login') }}</title>

    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('assets') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div style="text-align: center">
        <h1 class="logo-name" >{{config('app.name')}}</h1>
    </div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            <h3>Welcome to {{config('app.name')}}</h3>
            {{-- <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views. --}}
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" method="POST" role="form" action="{{route('login')}}">
                @csrf
                <div class="form-group @error('email') has-error @enderror">
                    <input id="email" name="email" type="text" class="form-control" placeholder="Username" value="{{ old('email') }}" required autocomplete="email" autofocus>

                </div>
                <div class="form-group @error('email') has-error @enderror @error('password') has-error @enderror @error('is_active') has-error @enderror">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                    @error('email')
                        <span class="help-block m-b-none" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    @error('password')
                        <span class="help-block m-b-none" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                    @error('is_active')
                        <span class="help-block m-b-none" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Login') }}</button>

                {{-- @if (Route::has('password.request'))
                <a href="{{route('password.request')}}"><small>{{ __('Forgot Your Password?') }}</small></a>
                @endif --}}
                {{-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{route('register')}}">Create an account</a> --}}
            </form>
            {{-- <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> --}}
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('assets') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>

</body>

</html>

