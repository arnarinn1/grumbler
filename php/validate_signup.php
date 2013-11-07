
<?php

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	//TODO: Validation


	if (isset($_POST["username"]) && isset($_POST["password"]))
	{
		//Check if username already exists in database
		$user_exist = $db->CheckIfUserExists($_POST["password"]);

		if ($user_exist)
			header("Location: error.php");

		//Basic sha1 password encryption, later implement salt hashing
		$password = sha1($_POST["password"]);

		$db->CreateNewUser($_POST["username"], $password);
	}
?>

