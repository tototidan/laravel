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


<div class="nameNote"><p>{{$users[0]["prenom"]." ".$users[0]["nom"]}}</p></div>

<div class="modifnotes">
    <p>Modifier notes </p>
    @foreach($users[0]['notes'] as $value)

        <form action="{{Route("notes.update",$value->id)}}" method="get">
            <label for="note">Note : </label>
            <input type="text" name="note" value="{{$value->note}}">
            <input type="hidden" name="coeff" value="1">
            <input type="submit" value="Changer la note">


        </form>


        @endforeach

</div>
<div class="addnotes">
<p>Ajouter notes </p>
    <form action="{{route("notes.store")}}" method="get">
        <label for="notes">Notes : </label>
        <input type="text" name="note"><br>

        <label for="coeff">Coefficient : </label>
        <input type="text" name="coeff">
        <input type="hidden" name="user_id" value="{{$users[0]["id"]}}"><br>
        <input type="submit">
    </form>

</div>


</body>




</html>

