@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')
<div class="profile-wrap">
  <div class="row">
    <div class="col-md-4 text-center">
      @if ($user->profile_photo)
        <p>
          <!--<img class="round-img" src="{{ asset('storage/user_images/' . $user->profile_photo) }}"/>-->
          <img class="round-img" src="{{ $user->profile_photo }}"/>
        </p>
      @else
          <img class="post-profile-icon round-img" src="/images/blank_profile.png" style="height: 100px; width:100px;"/>
      @endif
    </div>
    <div class="col-md-8">
      <div class="row">
          <h1>{{ $user->username }}</h1>
          @if ($user->id == Auth::user()->id)
            <a class="btn btn-outline-dark common-btn edit-profile-btn" href="/users/edit">Edit Profile</a>
            <a class="btn btn-outline-dark common-btn edit-profile-btn" rel="nofollow" data-method="POST" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
          @else
            <a class="d-flex align-items-center ml-4">@include('user_follow.follow_button', ['user' => $user])</a>
          @endif

      </div>
      <div class="row">
        <div class="d-flex">
          <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
          <div class="pr-5"><a class="black-color no-text-decoration text-dark" href="{{ route('users.followers', ['id' => $user->id]) }}"><strong>{{ $user->followers->count() }}</strong> followers</a></div>
          <div class="pr-5"><a class="black-color no-text-decoration text-dark" href="{{ route('users.followings', ['id' => $user->id]) }}"><strong>{{ $user->followings->count() }}</strong> following</a></div>
        </div>
      </div>
      
      <div class="row">
        <p class="pt-3">
          {{ $user->name }}
        </p>
      </div>
    </div>
    
    <div class="row col-md-12 pt-5">
      @foreach ($user->posts as $post) 
        <div class="col-4 pb-4 pt-4">
          <div class="image-wrapper">
            <a href="/posts/{{ $post->id }}">
              <img src="{{ $post->image }}">
            </a>
          </div>
        </div>
      @endforeach
    </div>
    
  </div>
</div>
@endsection