
	<?php include("views/header.php") ?>

		<div class="row">
			<div class="col-md-4">
				<form method="post" action="validate_login.php" class="form-signin">
					<h2 class="form-signin-heading">Please sign in</h2>
					<input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="">
					<input type="password" class="form-control" name="password" placeholder="Password" required="">
					<br>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in and stay grumpy</button>
				</form>
			</div>
		</div>
		<hr>
		<p class="lead"> New to Grumpy ? <a href="signup_user.php">Sign-up</a></p>

	<?php include("views/footer.php") ?>
	
	</body>
</html>