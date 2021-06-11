<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/model/user.php";

	class UserController
	{
		private static $instanse = null;

		public static function getInstance()
		{
			if(!self::$instanse)
			{
				self::$instanse = new UserController();
			}

			return self::$instanse;
		}

		public function insert($user_signup, $pass_signup, $date_current)
		{
			return User::getInstance()->insert($user_signup, $pass_signup, $date_current);
		}

		public function selectByUsername($username)
		{
			return User::getInstance()->selectByUsername($username);
		}

		public function checkLogin($user_signin, $pass_signin)
		{
			return User::getInstance()->checkLogin($user_signin, $pass_signin);
		}

		public function updatePassword($new_pass, $id_user)
		{
			return User::getInstance()->updatePassword($new_pass, $id_user);
		}
	}