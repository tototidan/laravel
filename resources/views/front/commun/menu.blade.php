<nav id="nav-wrap" class="nav-wrap1 twelve columns">
	{{ Html::image('image/ynov.jpg','Consulter',array('style' => "margin-left:40%;")) }}
   <a href="{{url('/deconnexion')}}"> <h4 class="deconnexion">Deconnexion</h4></a>


   <a href="{{ url('/') }}"> <h2 style="margin-left: 42%;">Liste des utilisateurs</h2></a>

   @if(session("isadmin") == true)
      <a href="{{ url('admin') }}"> <h2 style="margin-left: 42%;">Accèder a la partie admin</h2></a>
      @endif

   {{session("isadmin")}}

</nav>