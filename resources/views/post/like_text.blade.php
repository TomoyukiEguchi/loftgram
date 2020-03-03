@foreach ($post->likes as $like)
    @if ($loop->count == 1)
      Liked by <a class="no-text-decoration" href="/users/{{ $like->user->id }}"><strong><span class="text-dark">{{ $like->user->username }}</span></strong></a>
    @elseif ($loop->last)
      and <a class="no-text-decoration" href="/users/{{ $like->user->id }}"><strong><span class="text-dark">{{ $like->user->username }}</span></strong></a>
    @elseif (!$loop->first)
      and <strong>{{ $loop->count - 1 }} others</strong>
      @break
    @else
      Liked by <a class="no-text-decoration" href="/users/{{ $like->user->id }}"><strong><span class="text-dark">{{ $like->user->username }}</span></strong></a>, 
    @endif
@endforeach
