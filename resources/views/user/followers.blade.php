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
                      <div class="no-text-decoration" href="/users/{{ $user->id }}">
                        @if ($user->profile_photo)
                            <img class="post-profile-icon round-img" src="{{ $user->profile_photo }}"/>
                        @else
                            <img class="post-profile-icon round-img" src="/images/blank_profile.png"/>
                        @endif
                      </div>
                      <div class="black-color no-text-decoration" title="{{ $user->name }}" href="/users/{{ $user->id }}">
                        <strong>{{ $user->username }}</strong>
                      </div>
                      
                      <span style="position: absolute; right: 0">
                        <div class="mr-2">
                        @if ($user->id != Auth::user()->id)
                            @include('user_follow.follow_button', ['user' => $user])
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