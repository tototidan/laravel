@extends('front/default')
@section('content')
	<div class="box-body col-md-6">
		{!! BootForm::open()->action(route("users.update", array($user))) !!}
		{!! BootForm::hidden("_method")->value("put") !!}
		{!! BootForm::text("Nom", "nom")->placeholder("Entrez le nom de l'utilisateur")->required(true)->defaultValue($user->nom) !!}
		{!! BootForm::text("Prénom", "prenom")->placeholder("Entrez le prénom de l'utilisateur")->required(true)->defaultValue($user->prenom) !!}
		{!! BootForm::email("Email", "email")->placeholder("Entrez l'email de l'utilisateur")->required(true)->defaultValue($user->email) !!}
		{!! BootForm::password("Mot de passe", "password")->placeholder("Entrez le mot de passe de l'utilisateur") !!}
		{!! BootForm::password("Confirmer le Mot de passe", "password_confirmation")->placeholder("Confirmez le mot de passe de l'utilisateur") !!}
		<input class="btn btn-primary pull-right" type="submit" value="Modifier"/>
		{!! BootForm::close() !!}
	</div>
@endsection