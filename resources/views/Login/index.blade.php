<html>

@include('front.commun.header')
{{ Html::image('image/ynov.jpg','Consulter',array('style' => "margin-left:40%;")) }}

	<body>
	<div class="container">
		<div class="col-md-12">
			<h1 class="h1">Login</h1>
			{!! BootForm::open()->action(route("connexion"))->method("post") !!}
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="login" name="login" value="{{ old("login") }}">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="password" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox">
						<label>
							<input name="remember_token" type="checkbox"> Se rappeler de moi
						</label>
					</div>
				</div>
				<div class="col-xs-8">
					<div>
						<input  type="submit" class="btn btn-primary">
					</div>
				</div>
			</div>
			{!! BootForm::close() !!}
		</div>
	</div>
	</body>
</html>