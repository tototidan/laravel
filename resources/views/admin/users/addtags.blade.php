<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
        <meta name="viewport" content="width=device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable=no" />
        <meta name="author" content="Florian Cransac">
        {!!  Html::style("css/all.css") !!}


        {!! Html::style("css/menuCSS.css") !!}
        {!! Html::style("css/userContentCSS.css") !!}
        {!! Html::style("css/AdminCSS.css") !!}






    </head>

    <body>

    @include("admin.commun.alert")
    <div class="nameNote"><p>Tags</p></div>

    <div class="modifnotes">
        <p>Modifier notes </p>
        @foreach($tags as $value)

            <form action="{{Route("tags.delete",$value->id)}}" method="get">
                <label for="note">tags : </label>
                <input type="text" name="tags" value="{{$value->nom}}">

                <input type="submit" value="supprimer le tag ">


            </form>


    @endforeach
    </div>

    <div class="addnotes">
        <p>Ajouter notes </p>
        <form action="{{route("tags.store")}}" method="post">
            <label for="nom">Noms du tag : </label>
            <input type="text" name="nom"><br>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit">
        </form>

    </div>





    </body>
</html>