@extends('layouts.auth')

@section('register')
<div class="register-box">
    <!-- /.register-logo -->
    <div class="register-box-body">
        <div class="register-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/cashier.png') }}" alt="logo.png" width="150">
            </a>
        </div>

        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group has-feedback @error('name') has-error @enderror">
                <input type="text" name="name" class="form-control" placeholder="Name" required value="{{ old('name') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @error('name')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback @error('password') has-error @enderror">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group has-feedback @error('password_confirmation') has-error @enderror">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @error('password_confirmation')
                <span class="help-block">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>  
        <a href="{{ route('login') }}" class="text-center ">Already registered?
        </a>
    </div>
    <!-- /.register-box-body -->
</div>
@endsection