<!DOCTYPE html>
<html>
@include('admin.commun.header')
@include('admin.commun.menu')
<body class="hold-transition skin-blue sidebar-mini">

<section class="content">
	@include("admin.commun.alert")
	@yield("content")

</section>
@include("admin.commun.footer")


{!! Html::script("lib/jquery-3.1.0/jquery-3.1.0.min.js") !!}
{!! Html::script("lib/bootstrap-3.3.7/js/bootstrap.min.js") !!}
@yield("headerJS") {{--Inclus le JS spécifique à chaque page--}}
</body>
</html>