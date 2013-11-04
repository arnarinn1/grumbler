
<?php

	session_start();

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	$username = $_POST["username"];
	$password = $_POST["password"];

	$user_exist = $db->ValidateUserInput($username, $password);

	if ($user_exist == false)
		print "You noob, you have no account";
	else
	{
		$_SESSION['user'] = $user_exist['username']; 
        $_SESSION['pass'] = $user_exist['password']; 
        $_SESSION['userid'] = $user_exist['id']; 
        $_SESSION['logged'] = TRUE; 

		header("Location: users_page.php");
	}
	
?>