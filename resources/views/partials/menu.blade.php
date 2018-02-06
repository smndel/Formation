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
          <a href="{{route('home')}}">Accueil<span class="sr-only">(current)</span>
          </a>
        </li> 

        @foreach($types as $id => $type)
          <li><a href="{{route('type', $type)}}">{{$type}}</a></li>
        @endforeach
          <li><a href="#">Contact</a></li>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>