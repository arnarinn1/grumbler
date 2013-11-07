<!doctype html>
<html lang="en">
	<head>
		<title>Grumpy</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="css" href="../css/bootstrap.css">
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1> Grumpy </h1>
				<p class="lead"> Whoops, username or password didn't match, please try again! </p>
			</div>
			<div class="row">
				<div class="col-md-4">
					<form method="post" action="validate_user.php" class="form-signin">
						<h2 class="form-signin-heading">Please sign in</h2>
						<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="">
						<input type="password" class="form-control" name="password" placeholder="Password" required="">
						<label class="checkbox">
				        	<input type="checkbox" value="remember-me"> Remember me
				        </label>
        				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>