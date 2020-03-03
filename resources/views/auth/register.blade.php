@extends('layouts.app')
@include('footer')
@section('content')
<div class="main">
  <div class="card devise-card">
    <div class="form-wrap">
      <div class="form-group text-center">
        <h2 class="logo-img mx-auto"></h2>
        <p class="text-secondary">Sign up to see photos from your friends.</p>
      </div>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <!--<label for="name" class="col-md-4 control-label">Name</label>-->

                <div class="col-md-12">
                    <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <!--<label for="email" class="col-md-4 control-label">E-Mail Address</label>-->

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <!--<label for="username" class="col-md-4 control-label">Username</label>-->

                <div class="col-md-12">
                    <input id="username" type="username" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>

                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <!--<label for="password" class="col-md-4 control-label">Password</label>-->

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <!--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>-->

                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Sign up
                    </button>
                </div>
            </div>
        </form>
      <br>

      <p class="devise-link">
        Have an account?
        <a href="{{ route('login') }}">Log in</a>
      </p>
    </div>
  </div>
</div>
@endsection
