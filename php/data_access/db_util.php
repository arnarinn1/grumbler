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
					print '<p>' . $row["username"] . ' tweeted: <br>' . $row['message'] . "</p>";
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
				$preparedQuery = $db->prepare("SELECT * FROM users WHERE username= :username LIMIT 1");
				$preparedQuery->execute(array(':username' => $username));
				
				$rows = $preparedQuery->fetch(PDO::FETCH_NUM);

				return $rows[0]== 1 ? true : false;
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

				//Make sure we created the user
				if($user != null)
				{
					$this->InsertUserDetailed($user["id"]);	
				}
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function InsertUserDetailed($userId)
		{
			//TODO:Insert to detailed info table
			print $userId;
		}
	}  

?>