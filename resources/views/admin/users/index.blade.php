@extends("admin/default")

@section("content")
    <title>Index</title>
    <a href="javascript:popup('addtags')"> <h2 style="margin-left: 42%;">Création/suppression de tags</h2></a>
    <div class="block_array_admin">

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
                <td>
                    <a href="javascript:popup('addnotes?id={{$user->id}}')">Ajouter/modifier notes </a>
                </td>
                    <td>
                        <a href="{{url("adminpp?id=".$user->id)}}"> {{ Html::image('image/oeil.png','Consulter',array('class' => "img_array")) }}</a>
                    </td>
                    <td>
                        <a class="placesubmit" href="{{ route('user.delete', $user->id) }}">{{Html::image('image/delete.png'),'Supprimer'}} </a>
                    </td>

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>



    <div class="box-body col-md-6 form_admin">
        {!! BootForm::open()->action(route("users.store")) !!}
        {!! BootForm::text("Nom", "nom")->placeholder("Entrez le nom de l'utilisateur")->required(true) !!}
        {!! BootForm::text("Prénom", "prenom")->placeholder("Entrez le prénom de l'utilisateur")->required(true) !!}
        {!! BootForm::text("login", "login")->placeholder("Entrez le login de l'utilisateur")->required(true) !!}
        {!! BootForm::checkbox("Administrateur", "IsAdmin")->placeholder("L'utilisateur est-il administrateur ?")->required(false) !!}
        {!! BootForm::email("Email", "email")->placeholder("Entrez l'email de l'utilisateur")->required(true) !!}
        {!! BootForm::password("Mot de passe", "password")->placeholder("Entrez le mot de passe de l'utilisateur")->required(true) !!}
        {!! BootForm::password("Confirmer le Mot de passe", "password_confirmation")->placeholder("Confirmez le mot de passe de l'utilisateur")->required(true) !!}
        <input class="btn btn-primary pull-right" type="submit" value="Créer"/>
        {!! BootForm::close() !!}
    </div>

    <script type="text/javascript">

        function popup(page)
        {
            window.open(page, '', 'resizable=no, location=no, width=1000, height=600, status=no, menubar=no')
        }



    </script>


@endsection