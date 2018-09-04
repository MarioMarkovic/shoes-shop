@extends('layouts.app')

@section('title')
	CHECKOUT
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
	<div class="row register">
        <div class="col-md-6 col-md-offset-3">
                <h2>Fill in your details</h2>
                    <form method="POST" action="{{ route('public.checkout') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name">First Name:</label>
                            <input id="first_name" type="text" name="first_name" value="@guest{{ old('first_name') }}@else{{ Auth::user()->first_name}} @endguest" autofocus>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name">Last Name:</label>
                            <input id="last_name" type="text" name="last_name" value="@guest{{ old('last_name') }}@else{{ Auth::user()->last_name}}@endguest" >
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address:</label>
                            <input id="email" type="email" name="email" value="@guest{{ old('email') }}@else{{ Auth::user()->email }}@endguest">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city">City:</label>
                            <input id="city" type="text" name="city" value="@guest{{ old('city') }}@else{{ Auth::user()->city }}@endguest" required >
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('post_number') ? ' has-error' : '' }}">
                            <label for="post_number">Post Number:</label>
                            <input id="post_number" type="number" name="post_number" value="@guest{{ old('post_number') }}@else{{ Auth::user()->post_number }}@endguest" required >
                            @if ($errors->has('post_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('post_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                            <label for="street_name">Street Name:</label>
                            <input id="street_name" type="text" name="street_name" value="@guest{{ old('street_name') }}@else{{ Auth::user()->street_name }}@endguest" required >
                            @if ($errors->has('street_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('street_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                            <label for="street_number">Street Number:</label>
                            <input id="street_number" type="number" name="street_number" value="@guest{{ old('street_number') }}@else{{ Auth::user()->street_number }}@endguest" required >
                            @if ($errors->has('street_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('street_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone">Phone:</label>
                            <input id="phone" type="number" name="phone" value="@guest{{ old('phone') }}@else{{ Auth::user()->phone }}@endguest" required autofocus placeholder="Example: 91155677">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="clearfix">
                                <button class="pull-right" type="submit">
                                    Checkout
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection