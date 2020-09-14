@extends('layouts.app')

@section('content')
    <form name="loginForm" method="post" action="/login/login">
        @csrf
        <div class="form-group">
            <label for="login_email">E-mail*:</label>
            <input type="email" required name="login_email" id="login_email" class="form-control">
        </div>

        <div class="form-group">
            <label for="login_password">Password*:</label>
            <input type="password" required name="login_password" id="login_password" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>

    </form>
@endsection
