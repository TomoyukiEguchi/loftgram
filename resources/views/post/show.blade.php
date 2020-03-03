@extends('layouts.app')
@include('navbar')
@include('footer')

@section('content')

  <div class="col-md-10 col-md-2 mx-auto">
    <div class="card-wrap">
      <div class="card">
        
        <div class="row">
          <div class="col-8 pr-0">
              <a href="/users/{{ $post->user->id }}">
                <img src="{{ $post->image }}" class="card-img-top" />
              </a>
          </div>
          
          <div class="col-4 pl-0">
            <div class="card-header align-items-center d-flex">
              <a class="no-text-decoration" href="/users/{{ $post->user->id }}">
                @if ($post->user->profile_photo)
                    <img class="post-profile-icon round-img" src="{{ $post->user->profile_photo }}"/>
                @else
                    <img class="post-profile-icon round-img" src="/images/blank_profile.png"/>
                @endif
              </a>
              <a class="black-color no-text-decoration" title="{{ $post->user->username }}" href="/users/{{ $post->user->id }}">
                <strong>{{ $post->user->username }}</strong>
              </a>
              
                @if ($post->user->id == Auth::user()->id)
                    <a class="ml-auto mx-0 my-auto" rel="nofollow" href="/postsdelete/{{ $post->id }}">
                      <div class="delete-post-icon">
                      </div>
                    </a>
                @endif
            </div>
            
            <div class="card-body">
              <div>
                <span><strong>{{ $post->user->username }}</strong></span>
                <span>{{ $post->caption }}</span>
              </div>
              <div class="post-time no-text-decoration text-secondary mt-2">{{ $post->created_at }}</div>
              <hr>
              <div class="row parts">
                <div id="like-icon-post-{{ $post->id }}">
                  @if ($post->likedBy(Auth::user())->count() > 0)
                    <a class="loved hide-text" data-remote="true" rel="nofollow" data-method="DELETE" href="/likes/{{ $post->likedBy(Auth::user())->firstOrFail()->id }}"></a>
                  @else
                    <a class="love hide-text" data-remote="true" rel="nofollow" data-method="POST" href="/posts/{{ $post->id }}/likes"></a>
                  @endif
                </div>
                    <!--<a class="comment" href="#"></a>-->
              </div>
              <div id="like-text-post-{{ $post->id }}">
                @include('post.like_text')
              </div>
              
                <div id="comment-post-{{ $post->id }}">
                    @include('post.comment_list')
                </div>

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
  </div>
@endsection