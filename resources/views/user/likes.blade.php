@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')
<div class="profile-wrap">
    
@if (count($users) > 0)
        @foreach ($users as $user)
        <ul style="list-style: none; margin-bottom: 0;">
            <li class="col-md-6 col-md-2 mx-auto">
                <!--<div class="card-wrap">-->
                    <div class="card">
                    <div class="card-header align-items-center d-flex" style="position: relative">
                      <div class="no-text-decoration" href="/users/{{ $user->user->id }}">
                        @if ($user->user->profile_photo)
                            <img class="post-profile-icon round-img" src="{{ $user->user->profile_photo }}"/>
                        @else
                            <img class="post-profile-icon round-img" src="/images/blank_profile.png"/>
                        @endif
                      </div>
                      <div title="{{ $user->name }}">
                        <strong><a class="black-color no-text-decoration text-dark" href="/users/{{ $user->user->id }}">{{ $user->user->username }}</a></strong>
                      </div>
                      
                      <span style="position: absolute; right: 0">
                        <div class="mr-2">
                          @if ($user->user->id != Auth::user()->id)
                              <div style="display:flex; justify-content:flex-end; width:100%; padding:0;">@include('user_follow.follow_button', ['user' => $user->user])</div>
                          @endif
                        </div>
                      </span>
                    </div>
                    </div>
                <!--</div>-->
            </li>
        </ul>
        @endforeach
{!! $users->render() !!}
@endif

</div>
@endsection