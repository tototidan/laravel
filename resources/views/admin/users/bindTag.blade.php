<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="author" content="Florian Cransac">
    {!!  Html::style("css/all.css") !!}
    {!! Html::script("lib/jquery-3.1.0/jquery-3.1.0.min.js") !!}

    {!! Html::style("css/menuCSS.css") !!}
    {!! Html::style("css/userContentCSS.css") !!}
    {!! Html::style("css/AdminCSS.css") !!}






</head>

<body>

@include("admin.commun.alert")
<div class="nameNote"><p>Tags</p></div>


<div class="modifnotes">
    <p>Modifier Tags </p>
    @foreach($users[0]['tags'] as $value)
       <form action="{{url("debindTtoU")}}" method="post">
            <p style="display: inline-block">tags : {{$value->nom}}</p>
            <input name="user_id" type="hidden" value="{{$users[0]["id"]}}">
            <input name="tag_id", type="hidden" value="{{$value->id}}">
           <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" value="Délier le tag ">
        </form>
    @endforeach
</div>


<div class="addnotes">
    <p>Ajouter tags </p>
    <form action="{{url("bindTtoU")}}" method="post">
        <select name="tag_id">
            @foreach($tag as $mytag)
                <option value="{{$mytag["id"]}}">{{$mytag["nom"]}}</option>
                @endforeach
        </select>
        <input type="hidden" name="user_id" value="{{$users[0]["id"]}}">
        <input type="hidden" name="_token" value="{{csrf_token()}}"><br>
        <input type="submit" value="Lier le tag a l'utilisateur">
    </form>

</div>



<script type="text/javascript">
    $("document").ready()
    {


        function popup(page)
        {
            window.open(page, '', 'resizable=no, location=no, width=1000, height=600, status=no, menubar=no')
        }

    }




</script>

</body>
</html>