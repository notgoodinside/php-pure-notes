<?php
	class Database
	{
		private static $instanse = null;
		public $conn;
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $database = "php-pure-notes";

		private function __construct()
		{
			try {
				$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->pass);
				// set the PDO error mode to exception
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
			  echo "Connection failed: " . $e->getMessage();
			}
		}

		public static function getInstance()
		{
			if(!self::$instanse)
			{
				self::$instanse = new Database();
			}

			return self::$instanse;
		}

		public function getConnection()
		{
			return $this->conn;
		}
	}