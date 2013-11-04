<?php

	class DbUtil
	{
		private $database;

		public function __construct()
		{
			$this->database = new PDO("sqlite:grumpy.db") or die ("Can't establish a connection to the database");
		}

		public function GetMessages()
		{
			try
			{
				$result = $this->database->query("select u.username, m.message from messages as m 
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

		public function ValidateUserInput($username, $password)
		{
			$preparedQuery = $this->database->prepare("SELECT * FROM users WHERE username= :username and password= :password LIMIT 1");
			$preparedQuery->execute(array(':username' => $username, ':password' => $password));
			
			$rows = $preparedQuery->fetch(PDO::FETCH_NUM);
			
			$preparedQuery->execute(array(':username' => $username, ':password' => $password));
			$user = $preparedQuery->fetch(PDO::FETCH_ASSOC);
			
			return $rows[0] == 1 ? $user : false;
		}
	}  

?>