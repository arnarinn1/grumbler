<?php

	class DbUtil
	{
		private $datbaseName;

		public function __construct()
		{
			$this->databaseName = "sqlite:grumpy.db";
		}

		public function GetMessages()
		{
			try
			{
				$db = new PDO($this->databaseName) or die ("Can't establish a connection to the database");

				$result = $db->query("select u.username, m.message from messages as m 
									  join users as u on u.id = m.userid");

				foreach ($result as $row)
				{
					print '<p>' . $row["username"] . ' tweeted: <br>' . $row['message'] . "</p>";
				}
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e.getMessage();
			}
		}
	}  

?>