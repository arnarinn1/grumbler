
<?php

	session_start(); 

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

	require_once("data_access/db_util.php");
	$db = new DbUtil();

?>
			
	<?php include("views/header.php") ?>

	<aside>
		<ul class="nav nav-pills">
      		<li><a href="users_page.php">Grumps</a></li>
      		<li class="active"><a href="#">Following</a></li>
      		<li><a href="search_user.php">Search</a></li>
      		<li class="dropdown">
			  <a id="drop4" role="button" data-toggle="dropdown" href="#">Profile <b class="caret"></b></a>
			  <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="user_profile.php">View My Profile</a></li>
			    <li role="presentation" class="divider"></li>
			    <li role="presentation"><a role="menuitem" tabindex="-1" href="logout_user.php">Logout</a></li>
			  </ul>
			</li>
    	</ul>
    	<br>
    </aside>

    <?php include("views/filterMessagesView.php") ?>

    <h3>Following</h3>
    <div class="col-xs-12 col-md-8">
	    <?php 	
	    	$db->GetFollowingMessages($_SESSION['userid']);
	    ?>
    </div>
		
	<?php include("views/footer.php") ?>
	
	<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="../scripts/emoticons.js"></script>
	<script src="../scripts/bootstrap.js"></script>
	<script src="../scripts/filterMessages.js"></script>
	
	</body>
</html>