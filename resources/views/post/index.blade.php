@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')
@foreach ($posts as $post) 
  <div class="col-md-6 col-md-2 mx-auto">
    <div class="card-wrap">
      <div class="card">
        <div class="card-header align-items-center d-flex">
          <a class="no-text-decoration" href="/users/{{ $post->user->id }}">
            @if ($post->user->profile_photo)
                <img class="post-profile-icon round-img" src="{{ $post->user->profile_photo }}"/>
            @else
                <img class="post-profile-icon round-img" src="/images/blank_profile.png"/>
            @endif
          </a>
          <a class="black-color no-text-decoration text-dark" title="{{ $post->user->name }}" href="/users/{{ $post->user->id }}">
            <strong>{{ $post->user->username }}</strong>
          </a>
            @if ($post->user->id == Auth::user()->id)
              	<a class="ml-auto mx-0 my-auto" rel="nofollow" href="/postsdelete/{{ $post->id }}">
                  <div class="delete-post-icon">
                  </div>
              	</a>
            @endif
        </div>

        <a href="/posts/{{ $post->id }}">
          <img src="{{ $post->image }}" class="card-img-top" />
        </a>

        <div class="card-body">
          <div class="row parts">
            <div id="like-icon-post-{{ $post->id }}">
              @if ($post->likedBy(Auth::user())->count() > 0)
                <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $post->likedBy(Auth::user())->firstOrFail()->id }}">Delete like</a>
              @else
                <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/posts/{{ $post->id }}/likes">Like</a>
              @endif
            </div>
          </div>
          
          <div id="like-text-post-{{ $post->id }}">
            @include('post.like_text')
          </div>
          <div class="pt-2">
            <span><strong>{{ $post->user->username }}</strong></span>
            <span>{{ $post->caption }}</span>
            
            <div id="comment-post-{{ $post->id }}">
              @include('post.comment_list')
            </div>
            <div class="post-time no-text-decoration text-secondary mt-2">{{ $post->created_at }}</div>
            <hr>
            <div class="row actions" id="comment-form-post-{{ $post->id }}">
              <form class="w-100" id="new_comment" action="/posts/{{ $post->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="✓" />
             	  {{csrf_field()}}
             	  <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
             	  <input value="{{ $post->id }}" type="hidden" name="post_id" />
             	  <input class="form-control comment-input border-0" placeholder="Add a comment... " autocomplete="off" type="text" name="comment" />
             	</form>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>
@endforeach
@endsection