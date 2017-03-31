@extends('admin.default')


@section('content')

    <a href="javascript:popup(('bindTag?id={{$users[0]["id"]}}'))"> <h2 style="margin-left: 42%;">Gestions des tags </h2></a>

    {{ Html::image('image/spongebob.png','Image',array("class" => "placeimage")) }} <br><br>
    <form action="{{Route("user.update" , $users[0]['id'])}}" method="get">
    <input type="text" name="prenom" class="placename" value="{{$users[0]['prenom']}}" ><br><br>
    <input type="text" name="nom" class="placename" value="{{$users[0]['nom']}}"><br><br>
    <input type="text" name="email" class="placename" value="{{$users[0]['email']}}"><br><br>
        <input class="placesubmit" type="submit" value="Appliquez les changements">
    </form>

    <div  class="graphAdmin">
        <p>Moyenne : {{$moyenne}}</p>
        <div id="graph"></div>


    </div>

    <br>
    <div class="comm">
        <form action="POST">
            <label for="comm"><h2>Ecrire un commentaire</h2></label><br>
            <textarea rows="4" cols="50" placeholder="Votre commentaire ..." ></textarea><br>
            <input type="submit">
        </form>
    </div><br><br>


    @foreach($users[0]["commentaires"] as $value)

        <div class="afficheComm">

            <p class="commentaireP"><b>{{$value["auteur"]}}</b></br>{{$value['content']}}<br>

                <a href="{{ route('commentaire.delete' , $value["id"]) }}" >Supprimez commentaire</a>
            </p>
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
    <script type="text/javascript">
        function popup(page)
        {
            window.open(page, '', 'resizable=no, location=no, width=1000, height=600, status=no, menubar=no')
        }

    </script>

@endsection