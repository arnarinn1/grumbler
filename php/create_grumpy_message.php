
<?php

	session_start(); 

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	if (isset($_POST["message"]))
	{
		$userid = $_SESSION['userid'];
		$db->InsertMessage($userid, time(), $_POST["message"]);
	}

?>