@extends('front.default')


@section('content')


    {!! Lava::render('AreaChart', 'Population', 'graph2') !!}

	{{ Html::image('image/spongebob.png','Image',array("class" => "placeimage")) }} <br>

	<p  class="placename" >{{$users[0]['prenom']}}  {{$users[0]['nom']}} </p>



	<p class="placename2"> Mail : {{$users[0]['email']}}</p>

	<div  class="graph">
		<p> Moyenne : {{$moyenne}}</p>
		<img id="graph2">



	</div>



	<br>

	<div class="comm">
		<form action="{{Route("commentaire.store")}}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="user_id" value="{{$users[0]['id']}}">
			<input type="hidden" name="auteur_id" value="{{session("id")}}">
			<input type="hidden" name="auteur" value="{{session("name")}}">
			<label for="comm"><h2>Ecrire un commentaire</h2></label><br>
			<textarea name="content" rows="4" cols="50" placeholder="Votre commentaire ..." ></textarea><br>
			<input type="submit">
		</form>
	</div><br><br>

	@foreach($users[0]["commentaires"] as $value)

		<div class="afficheComm">

			<p class="commentaireP"><b>{{$value["auteur"]}}</b></br>{{$value['content']}}</p>
		</div>

	@endforeach

@endsection