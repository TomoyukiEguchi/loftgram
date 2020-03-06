@foreach ($post->likes as $like)
    @if ($loop->count == 1)
      Liked by <a class="no-text-decoration text-dark" href="/users/{{ $like->user->id }}"><strong>{{ $like->user->username }}</strong></a>
    @elseif ($loop->last)
      and <a class="no-text-decoration text-dark" href="/users/{{ $like->user->id }}"><strong>{{ $like->user->username }}</strong></a>
    @elseif (!$loop->first)
      and <a class="no-text-decoration text-dark" href="{{ route('likes.users', ['post' => $post->id]) }}"><strong>{{ $loop->count - 1 }} others</span></strong></a>
      @break
    @else
      Liked by <a class="no-text-decoration text-dark" href="/users/{{ $like->user->id }}"><strong>{{ $like->user->username }}</strong></a>, 
    @endif
@endforeach
