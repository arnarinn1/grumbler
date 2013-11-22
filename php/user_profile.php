
<?php
	session_start();

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	$followers = $db->GetFollowers($_SESSION['userid']);

	$userInfo = $db->GetDetailedInfo($_SESSION["userid"]);

	$userBirth = $userInfo["birthdate"];

	$dt = new DateTime("@$userBirth");
	$formattedDate = $dt->format('d/n/Y');
?>
			
	<?php include("views/header.php") ?>

	<ul class="nav nav-pills">
  		<li><a href="users_page.php">Grumps</a></li>
  		<li><a href="following_page.php">Following</a></li>
  		<li><a href="search_user.php">Search</a></li>
  		<li class="dropdown active">
		  <a id="drop4" role="button" data-toggle="dropdown" href="#">Profile <b class="caret"></b></a>
		  <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
		    <li role="presentation"><a role="menuitem" tabindex="-1" href="user_profile.php">View My Profile</a></li>
		    <li role="presentation" class="divider"></li>
		    <li role="presentation"><a role="menuitem" tabindex="-1" href="session/logout_user.php">Logout</a></li>
		  </ul>
		</li>
	</ul>
	<br>

	<?php include("views/user_information_box.php") ?>
	
    <?php include("views/filterMessagesView.php") ?>

    <h3> <?php echo $_SESSION["user"] ?> Grumpy Messages </h3>
    <div class="col-xs-12 col-md-8">
    	<?php $db->GetUserMessages($_SESSION["userid"]) ?>
    </div>
		
	</div>


	<?php include("views/footer.php") ?>

	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="../scripts/bootstrap.js"></script>
	<script src="../scripts/filterMessages.js"></script>
	
	</body>
</html>