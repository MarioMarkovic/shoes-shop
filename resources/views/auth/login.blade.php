@extends('layouts.app')
@section('title')
    Login
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
<div class="row login">
    <div class="col-md-6 col-md-offset-3">
        <h2>Login</h2>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address:</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group clearfix">
                    <label class="checkbox-label">
                        Remember Me
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                    </label>
                </div>

                <div class="form-group">
                    <button type="submit">
                        Login
                    </button>

                    <a href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                    
                </div>
            </form>
    </div>
</div>
@endsection
