<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/model/database.php";
	
	class User
	{
		private static $instanse = null;
		protected $conn;

		function __construct()
		{
			$this->conn = Database::getInstance()->conn;
		}
		public static function getInstance()
		{
			if(!self::$instanse)
			{
				self::$instanse = new User();
			}

			return self::$instanse;
		}

		public function selectByUsername($username)
		{
			$sql_get_data_user = "SELECT * FROM users WHERE username = :username";
			$stmt = $this->conn->prepare($sql_get_data_user);
			$stmt->bindParam(':username', $username);
			$stmt->execute();
			$count = $stmt->rowCount();
      		$row   = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		public function checkLogin($user_signin, $pass_signin)
		{
			$sql_check_login = "SELECT username FROM users WHERE username = :user_signin AND password = :pass_signin";
			$stmt = $this->conn->prepare($sql_check_login);
			$stmt->bindParam(':user_signin', $user_signin);
			$stmt->bindParam(':pass_signin', $pass_signin);
			$stmt->execute();
			$count = $stmt->rowCount();
      		$row   = $stmt->fetch(PDO::FETCH_ASSOC);

			return $count && $row;
		}

		public function updatePassword($new_pass, $id_user)
		{
			$sql_change_pass = "UPDATE users SET password = :new_pass WHERE id = :id_user";
			$stmt = $this->conn->prepare($sql_change_pass);
			$stmt->bindParam(':new_pass', $new_pass);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function insert($user_signup, $pass_signup, $date_current)
		{
			$sql_signup = "INSERT INTO users(username, password, date_signuped) VALUES (:user_signup, :pass_signup, :date_current)";
			$stmt = $this->conn->prepare($sql_signup);
			$stmt->bindParam(':user_signup', $user_signup);
			$stmt->bindParam(':pass_signup', $pass_signup);
			$stmt->bindParam(':date_current', $date_current);
			$stmt->execute();
			$count = $stmt->rowCount();

			return $this->conn->lastInsertId();
		}
	}