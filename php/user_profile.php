
<?php
	session_start();

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	$userInfo = $db->GetDetailedInfo($_SESSION["userid"]);

	$userBirth = $userInfo["birthdate"];

	$dt = new DateTime("@$userBirth");
	$formattedDate = $dt->format('d/n/Y');
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
	      		<li><a href="#">Search</a></li>
	      		<li class="active"><a href="user_profile.php">Profile </a></li>
	      		<li><a href="logout_user.php">Logout</a></li>
	    	</ul>
	    	</br>

	    	<div class="container">
		    <div class="row">
		        <div class="col-xs-12 col-sm-6 col-md-6">
		            <div class="well well-sm">
		                <div class="row">
		                    <div class="col-sm-6 col-md-4">
		                    	<?php 
		                        	print '<img src="pics/' . $_SESSION["user"] . '.png" alt="profile picture" class="img-rounded img-responsive" />';
		                        ?>
		                    </div>
		                    <div class="col-sm-6 col-md-8">
		                        <h4>
		                            <?php echo $userInfo["name"] ?>
		                        </h4>
		                        <small>
		                        	<cite title="San Francisco, USA"> <?php echo $userInfo["location"]?>
		                        		<i class="glyphicon glyphicon-map-marker"></i>
		                    		</cite>
		                    </small>
		                        <p>
		                            <i class="glyphicon glyphicon-user"></i><?php echo $_SESSION["user"] ?>
		                            <br />
		                            <i class="glyphicon glyphicon-gift"></i><?php echo $formattedDate ?>
		                            <br />
		                            <i class="glyphicon glyphicon-info-sign"></i><?php echo $userInfo["information"] ?></p> 
		                    </div>
		                </div>
		            </div> 
		        </div>
		    </div>

		    <h3> <?php echo $_SESSION["user"] ?> Grumpy Messages </h3>
		    <div class="col-xs-12 col-md-8">
		    	<?php $db->GetUserMessages($_SESSION["userid"]) ?>
		    </div>
		</div>

		</div>
		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="../scripts/bootstrap.js"/>
	</body>
</html>