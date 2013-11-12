
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
	      		<li><a href="user_profile.php">Profile </a></li>
	      		<li><a href="logout_user.php">Logout</a></li>
	    	</ul>
	    	</br>

	    	<div class="bs-example">
		      <form id="submitMessage" role="form" method="post" action="create_grumpy_message.php">
		        <textarea id="grumpyMessage" class="form-control" rows="3" name="message"></textarea>
		        <div class ="boxPadding">
		        	<div class="col-md-2">
			        	<select id="emoticons" class="form-control" name="emotion">
						  <option id="grumpy">Grumpy</option>
						  <option id="superangry">Super angry</option>
						  <option id="pissedoff">Pissed off</option>
						  <option id="annoyed">Annoyed</option>
						  <option id="terroristic">Terroristic</option>
						  <option id="hostile">Hostile</option>
						</select>
					</div>
					<img class="emoticonPadding" src="emoticons/grumpy.png" id="emoticonSmiley"/> 
		        	<button type="submit" id="submitMessageBtn" class="btn btn-primary">Do Some Bitching</button>
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
		<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
		<script src="../scripts/emoticons.js"></script>
		<script src="../scripts/bootstrap.js"/>
	</body>
</html>