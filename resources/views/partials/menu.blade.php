<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="{{route('home')}}">Formation</a>
    </div> -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

    <!--Nous mettons une condition, si nous somme sur le front, on affiche le menu complet, dans le back, on n'afficher que le dashboard et le logout-->

     
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="{{route('index')}}">Accueil<span class="sr-only">(current)</span>
          </a>
        </li> 
        @if(Route::is('post.*') == false)
        @forelse($types as $id => $type)
          <li><a href="{{route('type', $type)}}">{{$type}}</a></li>
        @empty
        @endforelse
          <li><a href="{{route('contact')}}">Contact</a></li>
        @endif
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

        {{-- renvoir true si vous êtes connecté --}}
        @if(Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{route('post.index')}}">Admin</a></li>
          <li> 
              <a href="{{route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
          </li>
        </ul> 
        @endif
</nav>