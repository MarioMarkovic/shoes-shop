@extends('layouts.app')
@section('title')
    Register
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
    <div class="row register">
        <div class="col-md-6 col-md-offset-3">
                <h2>Register</h2>
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name">First Name:</label>
                            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name">Last Name:</label>
                            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required >
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address:</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city">City:</label>
                            <input id="city" type="text" name="city" value="{{ old('city') }}" required >
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('post_number') ? ' has-error' : '' }}">
                            <label for="post_number">Post Number:</label>
                            <input id="post_number" type="number" name="post_number" value="{{ old('post_number') }}" required >
                            @if ($errors->has('post_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('post_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                            <label for="street_name">Street Name:</label>
                            <input id="street_name" type="text" name="street_name" value="{{ old('street_name') }}" required >
                            @if ($errors->has('street_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('street_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                            <label for="street_number">Street Number:</label>
                            <input id="street_number" type="text" name="street_number" value="{{ old('street_number') }}" required >
                            @if ($errors->has('street_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('street_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone">Phone:</label>
                            <input id="phone" type="number" name="phone" value="{{ old('phone') }}" required autofocus>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
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

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password:</label>
                            <input id="password-confirm" type="password"  name="password_confirmation" required>
                        </div>

                        <div class="form-group">
                            <div class="clearfix">
                                <button class="pull-right" type="submit">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
