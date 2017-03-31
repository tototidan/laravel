@extends('front/default')


@section('content')

	<title>Index</title>

	<div class="block_array">

		<table class="table">
			<thead>
			<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Email</th>
			</tr>
			</thead>
			<tbody>
			<tr>
                @foreach($users as $user)
				<td>{{$user->prenom}}</td>
				<td>{{$user->nom}}</td>
				<td>{{$user->email}}</td>
				<td><a href="{{ url('/userpp?id='.$user->id) }}"> {{ Html::image('image/oeil.png','Consulter',array('class' => "img_array")) }}</a></td>
			</tr>
            @endforeach

			</tbody>
		</table>
	</div>


    <div class="graph">
        <p class="brnEleve">Nombre d'élèves : {{count($users)}}</p>
        <p class="moyenne"> Moyenne de la classe : {{$moyenne}}</p>

        <div class="graphOlder"></div>


    </div>





@endsection
