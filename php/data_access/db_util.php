<?php

	class DbUtil
	{
		private $database;

		public function __construct()
		{
			$this->database = "sqlite:grumpy.db";
		}

		public function GetMessages()
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$result = $db->query("select u.username, m.message from messages as m 
									  join users as u on u.id = m.userid");

				foreach ($result as $row)
				{
					print '<div class="bs-callout bs-callout-info">';
					print '<h4>' . $row["username"] . ' is grumpy </h4>';
					print '<p>' . $row["message"] . '</p> </div>';
				}
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();
			}
		}

		public function ValidateUser($username, $password)
		{
			try 
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$preparedQuery = $db->prepare("SELECT * FROM users WHERE username= :username and password= :password LIMIT 1");
				$preparedQuery->execute(array(':username' => $username, ':password' => $password));
				
				$rows = $preparedQuery->fetch(PDO::FETCH_NUM);

				$preparedQuery->execute(array(':username' => $username, ':password' => $password));
				$user = $preparedQuery->fetch(PDO::FETCH_ASSOC);
				
				return $rows[0] == 1 ? $user : false;	
			} 
			catch (PDOException $e) 
			{
				print 'Exception: ' . $e->getMessage();
			}
		}

		public function CheckIfUserExists($username)
		{
			try 
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$preparedQuery = $db->prepare("SELECT 1 FROM users WHERE username = :username");
				$preparedQuery->bindParam(":username", $username);
				$preparedQuery->execute();
				
				if ($preparedQuery->fetch()) {
				  return true; } 
				else {
				  return false; }
			} 
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function CreateNewUser($username, $password)
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$insert = $db->prepare("INSERT INTO users(username, password) VALUES (:username, :password)");
				$insert->execute(array('username' => $username, 'password' => $password));

				//Get the new user id
				$preparedQuery = $db->prepare("SELECT * FROM users WHERE username= :username LIMIT 1");
				$preparedQuery->execute(array(':username' => $username));

				$user = $preparedQuery->fetch(PDO::FETCH_ASSOC);

				return $user["id"];	
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function InsertUserDetailed($userid, $firstname, $secname, $birthdate)
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$insert = $db->prepare("INSERT INTO user_detailed VALUES (:userid, :firstname, :secname, :birthdate, :pictureid)");
				
				$insert->execute(array('userid' => $userid, 'firstname' => $firstname, 'secname' => $secname, 'birthdate' => $birthdate, 'pictureid' => $userid));
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function InsertMessage($userid, $datetime, $message)
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$insert = $db->prepare("INSERT INTO messages(userid, datetime, message) VALUES (:userid, :datetime, :message)");
				$insert->execute(array('userid' => $userid, 'datetime' => $datetime, 'message' => $message));
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}
	}  

?>