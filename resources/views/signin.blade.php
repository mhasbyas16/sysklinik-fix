<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome, Login First</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link rel="stylesheet" href="{{ asset('/css/stylesignin.css') }}">
</head>
<body class="pt-5">
@include('sweet::alert')
	<div class="container-fluid pt-5">
		<div class="col-md-4 offset-4 p-3 mt-5 signin">
			<form action="{{ url('login') }}" class="form-horizontal col-md-12 p-3" method="post">
				@csrf
				<div class="row">
					<div class="text-center col-md-12">
						<h3>
							Login
						</h3>
					</div>
				</div>
				<div class="form-group row">
					<label class="text-muted" for="id_pegawai">ID Pegawai</label>
					<input type="text" placeholder="ID Pegawai" id="id_pegawai" class="form-control col-md-12" name="id_pegawai">				
				</div>
				<div class="form-group row">
					<label class="text-muted" for="exampleFormControlSelect1">Password</label>
					<input type="password" id="exampleFormControlSelect1" placeholder="Password" class="form-control col-md-12" name="password">
				</div>
				<div class="form-group row">
					<input type="submit" name="submit" class="btn btn-info col-md-12" value="Sign In">
				</div>
			</form>
		</div>
	</div>
</body>
</html>