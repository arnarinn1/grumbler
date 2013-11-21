
<?php
	
	session_start(); 

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

	$user = $_GET['user'];
	$userId = substr($user, strlen($user)-1, strlen($user));

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	$userInfo = $db->GetDetailedInfo($userId);

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
			
			<?php include("views/header.php") ?>

			<ul class="nav nav-pills">
	      		<li><a href="users_page.php">Grumps</a></li>
	      		<li><a href="#">Following</a></li>
	      		<li><a href="search_user.php">Search</a></li>
	      		<li class="dropdown active">
				  <a id="drop4" role="button" data-toggle="dropdown" href="#">Profile <b class="caret"></b></a>
				  <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="user_profile.php">View My Profile</a></li>
				    <li role="presentation" class="divider"></li>
				    <li role="presentation"><a role="menuitem" tabindex="-1" href="logout_user.php">Logout</a></li>
				  </ul>
				</li>
	    	</ul>
	    	</br>

	    	<div class="container">
			    <div class="row">
			        <div class="col-xs-12 col-sm-6 col-md-6">
			            <div class="well well-sm">
			                <div class="row">
			                    <div class="col-sm-6 col-md-4">
			                    	<?php 
			                        	print '<img src="pics/' . $userInfo['username'] . '.png" alt="profile picture" class="img-rounded img-responsive" />';
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
			                            <i class="glyphicon glyphicon-user"></i><?php echo $userInfo['username'] ?>
			                            <br />
			                            <i class="glyphicon glyphicon-gift"></i><?php echo $formattedDate ?>
			                            <br />
			                            <i class="glyphicon glyphicon-info-sign"></i><?php echo $userInfo["information"] ?></p> 
			                    </div>
			                </div>
			            </div> 
			        </div>
			    </div>
			</div>

		    <?php include("views/filterMessagesView.php") ?>

		    <h3> <?php echo $user ?> Grumpy Messages </h3>
		    <div class="col-xs-12 col-md-8">
		    	<?php $db->GetUserMessages($userId) ?>
		    </div>

		</div>

		<?php include("views/footer.php") ?>

		<script src="https://code.jquery.com/jquery.js"></script>
		<script src="../scripts/bootstrap.js"></script>
		<script src="../scripts/filterMessages.js"></script>
	</body>
</html>