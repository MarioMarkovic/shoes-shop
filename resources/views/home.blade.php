@extends('layouts.app')

@section('title')
    {{ Auth::user()->first_name }} - Dashboard
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row user-dashboard">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h2>Hi {{ Auth::user()->first_name }} !</h2>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil quibusdam, impedit placeat, saepe voluptas rem praesentium. Molestias cumque commodi, eum deserunt, corporis ratione iste soluta tempora recusandae adipisci qui quisquam.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod iste reiciendis delectus est a vero debitis vitae accusantium fugiat veritatis, enim pariatur recusandae error animi vel voluptatibus quam expedita porro?
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Your account details:</h3><br>
            <h4>First name: {{ Auth::user()->first_name }}</h4>
            <h4>Last name: {{ Auth::user()->last_name }}</h4>
            <h4>Email name: {{ Auth::user()->email }}</h4>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-12 register">
            <h3>Here you can change delivery address:</h3>
            <form action="{{ route('user.change', ['id' => Auth::user()->id ]) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <label for="city">City:</label>
                    <input id="city" type="text" name="city" value="{{ Auth::user()->city }}" required >
                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('post_number') ? ' has-error' : '' }}">
                    <label for="post_number">Post Number:</label>
                    <input id="post_number" type="number" name="post_number" value="{{ Auth::user()->post_number }}" required >
                    @if ($errors->has('post_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('post_number') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('street_name') ? ' has-error' : '' }}">
                    <label for="street_name">Street Name:</label>
                    <input id="street_name" type="text" name="street_name" value="{{ Auth::user()->street_name }}" required >
                    @if ($errors->has('street_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('street_name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                    <label for="street_number">Street Number:</label>
                    <input id="street_number" type="text" name="street_number" value="{{ Auth::user()->street_number }}" required >
                    @if ($errors->has('street_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('street_number') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone">Phone:</label>
                    <input id="phone" type="number" name="phone" value="{{ Auth::user()->phone }}" required autofocus>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit">Change</button>
            </form>
        </div>        
    </div>
</div>
@endsection
