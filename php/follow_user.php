
<?php

	session_start(); 

	if ($_SESSION["logged"] != true)
		header("Location: index.php");

	if (isset($_GET["id"]))
	{
		require_once("data_access/db_util.php");
		$db = new DbUtil();

		$following = $_GET['id'];
		$userid = $_SESSION['userid'];

		$db->InsertFollower($userid, $following);

		header("Location: following_page.php");
	}

?>