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
				$result = $db->query("SELECT u.id, u.username, m.message, m.datetime, m.emotion from messages as m 
									  join users as u on u.id = m.userid
									  order by m.datetime desc
									  limit 20");

				foreach ($result as $row)
				{
					print '<div class="bs-callout bs-callout-info">';
					print '<div class="picture-size">';
					print '<a class="pull-left" href="view_user.php?user=' . $row['username'] . $row['id'] . '">';
					print '<img class="pull-left" src="pics/' . $row["username"] .'.png"/></a></div>';
					print '<h4>' . $row["username"] . ' is ' . $row["emotion"] .' <img class="emoticon" src=" ' . $this->GetEmotionUrl($row["emotion"]) . '"/></h4>';
					print '<p>' . $row["message"] . '</p>';
					$messageDate = $row["datetime"];
					$dt = new DateTime("@$messageDate");
					$formattedDate = $dt->format('d/n/Y H:i');

					print '<p class="text-muted">Grumpd at ' . $formattedDate . '</p> </div>' ;
				}
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();
			}
		}

		public function GetUserMessages($userid)
		{
			try 
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");

				$preparedQuery = $db->prepare("SELECT u.username, m.message, m.datetime, m.emotion FROM messages AS m
											   join users as u on u.id = m.userid 
											   WHERE userid= :userid
											   order by m.datetime desc
											   LIMIT 15");

				$preparedQuery->execute(array(':userid' => $userid));
				$result = $preparedQuery->fetchAll();

				foreach ($result as $row)
				{
					print '<div class="bs-callout bs-callout-info">';
					print '<div class="picture-size"><img class="pull-left" src="pics/' . $row["username"] .'.png"/></div>';
					print '<h4>' . $row["username"] . ' is ' . $row["emotion"] .' <img class="emoticon" src=" ' . $this->GetEmotionUrl($row["emotion"]) . '"/></h4>';
					print '<p>' . $row["message"] . '</p> ';

					$messageDate = $row["datetime"];
					$dt = new DateTime("@$messageDate");
					$formattedDate = $dt->format('d/n/Y H:i');

					print '<p class="text-muted">Grumpd at ' . $formattedDate . '</p> </div>' ;
				}
			} 
			catch (PDOException $e) 
			{
				print 'Exception: ' . $e->getMessage();
			}
		}

		public function SearchUsers($username)
		{
			try 
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");

				$preparedQuery = $db->prepare("SELECT u.id, u.username, ud.name, ud.location from users as u
											   join user_detailed as ud on u.id = ud.userid
											   WHERE u.username like ?
											   LIMIT 15");

				$preparedQuery->execute(array("%$username%"));
				$results = $preparedQuery->fetchAll();

				return $results;
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
				
				$user = $preparedQuery->fetch(PDO::FETCH_ASSOC);

				return $user != null ? $user : false;	
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

		public function InsertUserDetailed($userid, $name, $location, $information, $birthdate)
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$insert = $db->prepare("INSERT INTO user_detailed VALUES (:userid, :name, :location, :birthdate, :information ,:pictureid)");
				
				$insert->execute(array('userid' => $userid, 'name' => $name, 'location' => $location, 'birthdate' => $birthdate, 'information' => $information , 'pictureid' => $userid));
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function InsertMessage($userid, $datetime, $message, $emotion)
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$insert = $db->prepare("INSERT INTO messages(userid, datetime, message, emotion) VALUES (:userid, :datetime, :message, :emotion)");
				$insert->execute(array('userid' => $userid, 'datetime' => $datetime, 'message' => $message, "emotion" => $emotion));
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function GetDetailedInfo($userid)
		{
			try 
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$preparedQuery = $db->prepare("SELECT * FROM user_detailed as ud 
											   join users as u on u.id = ud.userid
											   WHERE ud.userid= :userid");
				$preparedQuery->execute(array(':userid' => $userid));

				$user = $preparedQuery->fetch(PDO::FETCH_ASSOC);

				return $user;
			} 
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function InsertFollower($userid, $following)
		{
			try
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");
				$insert = $db->prepare("INSERT INTO follows VALUES (:userid, :following)");
				
				$insert->execute(array('userid' => $userid, 'following' => $following));
			}
			catch (PDOException $e)
			{
				print 'Exception: ' . $e->getMessage();	
			}
		}

		public function GetFollowingMessages($userid)
		{
			try 
			{
				$db = new PDO($this->database) or die ("Can't establish a connection to the database");

				$preparedQuery = $db->prepare("SELECT u.id, u.username, m.message, m.datetime, m.emotion
											   from messages as m 
											   join users as u on m.userid=u.id
											   where m.userid in 
											   					(select following 
											   				     from follows where userid = :userid) 
											   order by m.datetime desc
											   limit 20");	

				$preparedQuery->execute(array(':userid' => $userid));
				$messages = $preparedQuery->fetchAll();

				foreach($messages as $row)
				{
					$messageDate = $row["datetime"];
					$dt = new DateTime("@$messageDate");
					$formattedDate = $dt->format('d/n/Y H:i');
					
					print '<div class="bs-callout bs-callout-info">';
					print '<div class="picture-size">';
					print '<a class="pull-left" href="view_user.php?user=' . $row['username'] . $row['id'] . '">';
					print '<img class="pull-left" src="pics/' . $row["username"] .'.png"/></a></div>';
					print '<h4>' . $row["username"] . ' is ' . $row["emotion"] .' <img class="emoticon" src=" ' . $this->GetEmotionUrl($row["emotion"]) . '"/></h4>';
					print '<p>' . $row["message"] . '</p>';

					print '<p class="text-muted">Grumpd at ' . $formattedDate . '</p> </div>' ;
				}
			} 
			catch (PDOException $e) 
			{
				print 'Exception: ' . $e->getMessage();
			}
		}

		public function GetEmotionUrl($emotion)
		{
			return 'emoticons/' . strtolower(preg_replace('/\s+/', '', $emotion)) . '.png';
		}
	}  

?>
