
<?php

	require_once("data_access/db_util.php");
	$db = new DbUtil();

	//TODO: Implement validation

	if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"]) && isset($_POST["location"]) && isset($_POST["information"])
		&& isset($_POST["birthdate"]))
	{
		//Post variables
		$username = strip_tags($_POST["username"]);
		//Basic sha1 password encryption, later implement salt hashing
		$password = sha1(strip_tags($_POST["password"]));
		$name = strip_tags($_POST["name"]);
		$location = strip_tags($_POST["location"]);
		$personalInfo = strip_tags($_POST["information"]);

		//Convert date to epoch
		if ((strtotime($_POST["birthdate"])) == true) 
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
				print 'Oops!  Your file\'s size is to large.';
				return;
			}

			$pictureTarget = "pics/";
			$pictureTarget = $pictureTarget . $_POST["username"] . '.png';

			if(move_uploaded_file($_FILES['photo']['tmp_name'], $pictureTarget)) 
			{
			    print "The file ". basename( $_FILES['photo']['name']). " has been uploaded, and your information has been added to the directory";
			} 
			else 
			{
			    print "Sorry, there was a problem uploading your file.";
			}
			
		}
		else
		{
			print 'Ooops!  Your upload triggered the following error:  '. $_FILES['photo']['error'];
		}
	}
?>

