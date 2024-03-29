@extends('layouts.app')
@include('footer')

@section('content')
<div class="main">
  <div class="card devise-card">
    <div class="form-wrap">
      <div class="form-group text-center">
        <h2 class="logo-img mx-auto"></h2>
      </div>
      <form class="new_user" id="new_user" action="{{ route('login') }}" accept-charset="UTF-8" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <input id="email" type="email" class="form-control" name="email"  placeholder="Email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
          <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        
        <div class="actions">
          <input type="submit" name="commit" value="Log in" class="btn btn-primary w-100">
        </div>
      </form>

      <br>

      <p class="devise-link">
        Don't have an account? 
        <a href="{{ route('register') }}">Sign up</a>
      </p>

    </div>
  </div>
</div>
@endsection