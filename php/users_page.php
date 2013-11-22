
<?php

	session_start(); 

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

?>
	
	<?php include("views/header.php") ?>

	<aside>
		<ul class="nav nav-pills">
      		<li class="active"><a href="#">Grumps</a></li>
      		<li><a href="following_page.php">Following</a></li>
      		<li><a href="search_user.php">Search</a></li>
      		<li class="dropdown">
			  <a id="drop4" role="button" data-toggle="dropdown" href="#">Profile <b class="caret"></b></a>
			  <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="user_profile.php">View My Profile</a></li>
			    <li role="presentation" class="divider"></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="session/logout_user.php">Logout</a></li>
			  </ul>
			</li>
    	</ul>
    	<br>
    </aside>
    	
	<?php include("views/messageForm.php") ?>

	<?php include("views/filterMessagesView.php") ?>

	<br>
	<br>
    <h3>Grumpy messages</h3>
    <?php

    	require_once("data_access/db_util.php");
		$db = new DbUtil();

		$messages = $db->GetMessages();
    ?>
	
	<?php include("views/footer.php") ?>
		
	<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="../scripts/emoticons.js"></script>
	<script src="../scripts/bootstrap.js"></script>
	<script src="../scripts/filterMessages.js"></script>

	</body>
</html>