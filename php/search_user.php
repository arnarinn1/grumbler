
<?php

	session_start(); 

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

?>

<!doctype html>
<html lang="en">
	<head>
		<title>Grumpy</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="css" href="../css/docs.css">
		<link rel="stylesheet" type="css" href="../css/mine.css">
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1> Grumpy </h1>
				<p class="lead"> Welcome to grumpy, a place to bitch about all your problems </p>
			</div>

			<ul class="nav nav-pills">
	      		<li><a href="users_page.php">Grumps</a></li>
	      		<li><a href="#">Following</a></li>
	      		<li class="active"><a href="search_user.php">Search</a></li>
	      		<li><a href="user_profile.php">Profile </a></li>
	      		<li><a href="logout_user.php">Logout</a></li>
	    	</ul>
	    	</br>

	    	<h3> Search Users on Grumpy </h3>
	    	<hr>
	    	<form method="post" action="search_user.php" class="form-inline" role="form">
			  <div class="form-group">
			    <label class="sr-only" for="searchUser">Search User</label>
			    <input type="text" class="form-control" id="searchUser" name="searchUser" placeholder="Search User">
			  </div>
			  <button type="submit" class="btn btn-default">Search</button>
			</form>
			<br>

			<?php

				if (isset($_POST["searchUser"]) && $_POST["searchUser"] != null)
				{
					require_once("data_access/db_util.php");
					$db = new DbUtil();

					$user = strip_tags($_POST["searchUser"]);

					$results = $db->SearchUsers($user);

					print '<h4> Found ' . sizeof($results) . ' users';

						
					foreach ($results as $row) 
					{
			?>	
					<br>
					<br>
					<div class="row">
					    <div class="col-lg-5">
					        <div class="media">
					            <a class="pull-left" href="#">
					                <?php 
					                	print '<img class="media-object dp img-circle"
					                src="pics/' . $row["username"] . '.png" style="width: 100px;height:100px;">';
					                ?>
					            </a>
					            <div class="media-body">
					            	<?php
					                	print '<h4 class="media-heading">' . $row['name'] . '</h4>';
					                	print '<h5>Username: ' . $row['username'] . ' </h5>';
					                	print '<h5>Location: ' . $row['location'] . ' </h5>';
					                	print '<hr style="margin:8px auto">';
					                ?>
					            </div>
					        </div>
					    </div>
					</div>
					<br>

			<?php }} ?>

		<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="../scripts/bootstrap.js"></script>
	</body>
</html>