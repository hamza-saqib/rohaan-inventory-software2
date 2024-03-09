{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
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
@endsection --}}
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{config('app.name')}} | {{ __('Register') }}</title>

    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div style="text-align: center">
        <h1 class="logo-name" >{{config('app.name')}}</h1>
    </div>
    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <h3>Register to {{config('app.name')}}</h3>
            <p>Create account to see it in action.</p>
            <form class="m-t" method="POST" role="form" action="{{route('register')}}">
                @csrf
                <div class="form-group @error('name') has-error @enderror">
                    <input id="name" name="name" type="text" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="help-block m-b-none" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group @error('email') has-error @enderror">
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="help-block m-b-none" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group @error('password') has-error @enderror">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required autocomplete="new-password">
                    @error('password')
                        <span class="help-block m-b-none" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                </div>
                {{-- <div class="form-group">
                        <div class="checkbox i-checks"><label> <input type="checkbox" required><i></i> Agree the terms and policy </label></div>
                </div> --}}
                <button type="submit" class="btn btn-primary block full-width m-b">{{ __('Register') }}</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{route('login')}}">Login</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('assets') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="{{ asset('assets') }}/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
