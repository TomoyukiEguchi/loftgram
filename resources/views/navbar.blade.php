@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <div><img src="/svg/ghosts-pacman.svg" style="height: 35px; border-right: 1px solid #333;" class="pr-3"></div>
            <div class="navbar__brand navbar__mainLogo ml-2"></div>
        </a>
        <!--<a class="navbar__brand navbar__mainLogo" href="/"></a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-md-auto align-items-center">
            <li>
              <!--<a class="btn btn-primary" href="/posts/new">Post</a>-->
              <a class="nav-link commonNavIcon post-icon" href="/posts/new"></a>
            </li>
            <li>
              <a class="nav-link commonNavIcon profile-icon" href="/users/{{ Auth::user()->id }}"></a>
              <!--<a class="" href="/users/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a>-->
            </li>
          </ul>
        </div>
      </div>
    </nav>
@endsection