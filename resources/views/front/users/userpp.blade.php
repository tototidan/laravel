@extends('front.default')


@section('content')

	<title>{{Session("name")}}</title>
    {!! Lava::render('AreaChart', 'Population', 'graph2') !!}

	@if($users[0]['image']['file_path'] != null)
		{{ Html::image($users[0]['image']['file_path'],'Image',array("class" => "placeimage")) }} <br>


	@else

	{{ Html::image('image/spongebob.png','Image',array("class" => "placeformimage")) }} <br>
		@endif

	@if(Session("id") == $users[0]["id"])
		<div class="placeimage">
			<form action="{{url("imageUploadPost")}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="user_id" value="{{$users[0]["id"]}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<label for="image">Choissisez votre image de profil</label>
				<input type="file" name="image">
				<input type="submit" value="Changez l'image de profil">

			</form>
		</div>
	@endif

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


	<div class="container" style="margin-top:20px;">
		<div class="row">

			<div class="col-md-12">
				<div class="tag-list well">
					@foreach($users[0]["tags"] as $value)
					<a href="#" class="btn btn-primary" role="button">{{$value["nom"]}}</a>
						@endforeach

				</div>
			</div>
		</div>

	</div>

@endsection