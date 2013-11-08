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
				<p class="lead"> Welcome to grumpy, a place to bitch about all your problems </p>
			</div>
			<div class="row">
				<div class="col-md-4">
					<form method="post" action="validate_signup.php" enctype="multipart/form-data">
						<h2 class="form-signin-heading">Enter your credentials</h2>
						
						<div class="form-group">
						    <label for="input_username">Username</label>
						    <input type="text" class="form-control" id="input_username" name="username" placeholder="Enter username">
						</div>

						<div class="form-group">
						    <label for="input_password">Password</label>
						    <input type="password" class="form-control" id="input_password" name="password" placeholder="Enter password">
						</div>

						<div class="form-group">
						    <label for="input_birthdate">Date of Birth</label>
						    <input type="text" class="form-control" id="input_birthdate" name="birthdate" placeholder="Enter date of birth">
						</div>

						<div class="form-group">
						    <label for="input_first">First name</label>
						    <input type="text" class="form-control" id="input_first" name="firstname" placeholder="Enter first name">
						</div>

						<div class="form-group">
						    <label for="input_second">Second name</label>
						    <input type="text" class="form-control" id="input_second" name="secondname" placeholder="Enter second name">
						</div>

						<div class="form-group">
						    <label for="input_file">File input</label>
						    <input type="file" id="input_file" name="photo">
						</div>

        				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up and stay grumpy</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>