
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
	      		<li class="active"><a href="#">Grumps</a></li>
	      		<li><a href="#">Following</a></li>
	      		<li><a href="#">Search</a></li>
	      		<li><a href="user_profile.php">Profile </a>
	    	</ul>
	    	</br>

	    	<div class="bs-example">
		      <form role="form" method="post" action="create_grumpy_message.php">
		        <textarea class="form-control" rows="3" name="message"></textarea>
		        <div class ="boxPadding">
		        	<button type="submit" class="btn btn-primary">Do some bitching</button> 
		        </div>
		      </form>
		    </div>
		    <br>
		    <h3>Grumpy messages</h3>
			    <?php

			    	require_once("data_access/db_util.php");
					$db = new DbUtil();

					$messages = $db->GetMessages();
			    ?>
		</div>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="../scripts/bootstrap.js"/>
	</body>
</html>