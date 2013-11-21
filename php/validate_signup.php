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
				<p class="lead"> Not Valid Information </p>
			</div>

<?php

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	$valid = ValidateInput();

	if ($valid == false)
		return;

	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["location"]) && isset($_POST["information"])
		&& isset($_POST["birthdate"]))
	{
		//Post variables
		$username = strip_tags($_POST["username"]);
		//Basic sha1 password encryption
		$password = sha1(strip_tags($_POST["password"]));
		$name = strip_tags($_POST["name"]);
		$location = strip_tags($_POST["location"]);
		$personalInfo = strip_tags($_POST["information"]);


	    $birthDate = strtotime($_POST["birthdate"]);

		//Check if username already exists in database
		$user_exist = $db->CheckIfUserExists($username );

		if ($user_exist)
		{
			header("Location: error.php");
		}
		
		$userid = $db->CreateNewUser($username, $password);
		$db->InsertUserDetailed($userid, $name, $location, $personalInfo, $birthDate);
		}
	else
	{
		header("Location: error.php");
	}

	//Upload the picture to the server
	if($_FILES['photo']['name'])
	{
		if(!$_FILES['photo']['error'])
		{
			$new_file_name = $_POST["username"];
			if($_FILES['photo']['size'] > (1024000)) 
			{
				$valid_file = false;
				$fileError = 'Oops!  Your file\'s size is to large.';
				return;
			}

			$pictureTarget = "pics/";
			$pictureTarget = $pictureTarget . $_POST["username"] . '.png';

			if(move_uploaded_file($_FILES['photo']['tmp_name'], $pictureTarget)) 
			{
			    header ("Location: signup_successful.php");
			} 
			else 
			{
			   header("Location: error.php");
			}
		}
		else
		{
			header("Location: error.php");
		}
	}

	function ValidateInput()
	{
		$errors = array();

		if($_POST['username'] == null)
			array_push($errors, "Username can't be empty");

		if($_POST['password'] == null)
			array_push($errors, "Must enter a password");

		if(!ctype_alnum($_POST['username']) && strlen($_POST['username']) < 50)
			array_push($errors, "Username must be AlphaNumeric and less then 50 characters in length");

		if ((strtotime($_POST["birthdate"])) == false)
	   		array_push($errors, "Date of Birth must be in correct format, see placeholder");

	   	if(strlen($_POST['name']) > 50 || $_POST['name'] == null)
			array_push($errors, "Name must be less then 50 characters in length and can't be empty");

		if(strlen($_POST['location']) > 100)
			array_push($errors, "Location must be less then 100 characters");

		if(strlen($_POST['information']) > 250)
			array_push($errors, "Personal information must be less then 250 characters in length");

		if($_FILES['photo']['name'] == null) 
			array_push($errors, "Must upload a picture");

		if($_FILES['photo']['size'] > 2097152) 
			array_push($errors, "Picture size must be less than 2 MB");

		if ($_FILES["photo"]["type"] != "image/jpeg" && $_FILES["photo"]["type"] != "image/png")
			array_push($errors, "Picture must be either jpg or png");

		if (sizeof($errors) > 0)
		{
			print '<div class="bs-callout bs-callout-danger">';
	    	print '<h4>Validation Errors</h4>';
			foreach ($errors as $error)
	   		{	
		        print '<p> ' . $error . '</p>';
	   		}
	   		print '</div>';
	   		print '<a href="signup_user.php">Signup Page</a>';
		}

	   	return sizeof($errors) == 0;
	}
?>

	</div>
</body>
</html>

