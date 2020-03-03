@extends('layouts.app')
@include('navbar')
@include('footer')
@include('common.errors')
@section('content')
<div class="col-md-offset-2 mb-4 edit-profile-wrapper">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="profile-form-wrap">
        <form class="edit_user" enctype="multipart/form-data" action="/users/update" accept-charset="UTF-8" method="post">
          <input name="utf8" type="hidden" value="✓" />
          <input type="hidden" name="id" value="{{ $user->id }}" />
          {{csrf_field()}} 
          <div class="form-group">
            <label for="user_profile_photo">Profile Photo</label><br>
                @if ($user->profile_photo)
                    <p>
                        <img class="round-img" src="{{ $user->profile_photo }}" style="height: 100px;" alt="avatar" />
                    </p>
                @else
                    <img class="post-profile-icon round-img" src="/images/blank_profile.png"/>
                @endif
            <input type="file" name="user_profile_photo"  value="{{ old('user_profile_photo',$user->id) }}" accept="image/jpeg,image/gif,image/png" />
          </div>

          <div class="form-group">
            <label for="user_name">Name</label>
            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('user_name',$user->name) }}" name="user_name" />
          </div>

          <div class="form-group">
            <label for="user_email">Email</label>
            <input autofocus="autofocus" class="form-control" type="email" value="{{ old('user_email',$user->email) }}" name="user_email" />
          </div>

          <div class="form-group">
            <label for="user_username">Username</label>
            <input autofocus="autofocus" class="form-control" type="text" value="{{ old('user_username',$user->username) }}" name="user_username" />
          </div>

          <div class="form-group">
            <label for="user_password">Password</label>
            <input autofocus="autofocus" class="form-control" type="password" name="user_password" />
          </div>

          <div class="form-group">
            <label for="user_password_confirmation">Confirm Password</label>
            <input autofocus="autofocus" class="form-control" type="password" name="user_password_confirmation" />
          </div>

          <input type="submit" name="commit" value="Update" class="btn btn-primary" data-disable-with="Update" />
        </div>
      </form>
    </div>
  </div>
</div>
@endsection