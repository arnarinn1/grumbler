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
			    <?php
			    	//Detect if browser is chrome, then set input type as date, else set placeholder

			    	//Make sure ther serves set the user_agent variable
			    	if(isset($_SERVER['HTTP_USER_AGENT'])) {
				    	$agent = $_SERVER['HTTP_USER_AGENT']; }
					
					//Browser is chrome, set date type
					if(strlen(strstr($agent,"Chrome")) > 0 ) { 
				  		print '<input type="date" class="form-control" id="input_birthdate" name="birthdate">'; }
					else {
						print '<input type="text" class="form-control" id="input_birthdate" name="birthdate" placeholder="dd-mm-yyyy">';
					}
			    ?>
			</div>
			
			<div class="form-group">
			    <label for="input_name">Name</label>
			    <input type="text" class="form-control" id="input_name" name="name" placeholder="Enter name">
			</div>

			<div class="form-group">
			    <label for="input_location">Location</label>
			    <input type="text" class="form-control" id="input_location" name="location" placeholder="Where are you from?">
			</div>

			<div class="form-group">
			    <label for="input_information">Personal Information</label>
			    <input type="text" class="form-control" id="input_information" name="information" placeholder="Enter personal information">
			</div>

			<div class="form-group">
			    <label for="input_file">File input</label>
			    <input type="file" id="input_file" name="photo">
			</div>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign up and stay grumpy</button>
		</form>
	</div>
</div>