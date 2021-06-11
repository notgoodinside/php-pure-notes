<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/model/database.php";
	
	class Note
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
				self::$instanse = new Note();
			}

			return self::$instanse;
		}

		public function insert_id()
		{
			return $this->conn->lastInsertId();
		}

		public function selectById($id, $id_user)
		{
			$sql_get_data_notes = "SELECT * FROM notes WHERE id = :id AND user_id = :id_user";
			$stmt = $this->conn->prepare($sql_get_data_notes);
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->execute();
			$count = $stmt->rowCount();
      		$row   = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		public function selectByIdUser($id_user)
		{
			$sql_get_data_list_note = "SELECT * FROM notes WHERE user_id = :id_user ORDER BY id DESC";
			$stmt = $this->conn->prepare($sql_get_data_list_note);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->execute();
			$count = $stmt->rowCount();
      		$rows   = $stmt->fetchAll();

			return $rows;
		}

		public function create($user_id, $title_create_note, $body_create_note, $date_current)
		{
			$sql_create_note = "INSERT INTO notes(user_id, title, body, date_created) VALUES (:user_id, :title_create_note, :body_create_note, :date_current)";
			$stmt = $this->conn->prepare($sql_create_note);
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':title_create_note', $title_create_note);
			$stmt->bindParam(':body_create_note', $body_create_note);
			$stmt->bindParam(':date_current', $date_current);
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function checkNote($id_user, $id_edit_note)
		{
			$sql_check_id_exist = "SELECT id, user_id FROM notes WHERE user_id = :id_user AND id = :id_edit_note";
			$stmt = $this->conn->prepare($sql_check_id_exist);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->bindParam(':id_edit_note', $id_edit_note);
			$stmt->execute();
			$count = $stmt->rowCount();
      		$row   = $stmt->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		public function update($body_edit_note, $title_edit_note, $id_user, $id_edit_note)
		{
			$sql_edit_note = "UPDATE notes SET body = :body_edit_note, title = :title_edit_note
                WHERE user_id = :id_user AND id = :id_edit_note";
			$stmt = $this->conn->prepare($sql_edit_note);
			$stmt->bindParam(':body_edit_note', $body_edit_note);
			$stmt->bindParam(':title_edit_note', $title_edit_note);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->bindParam(':id_edit_note', $id_edit_note);
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

		public function delete($id_user, $id_edit_note)
		{
			$sql_delete_note = "DELETE FROM notes WHERE user_id = :id_user AND id = :id_edit_note";
			$stmt = $this->conn->prepare($sql_delete_note);
			$stmt->bindParam(':id_user', $id_user);
			$stmt->bindParam(':id_edit_note', $id_edit_note);
			$stmt->execute();
			$count = $stmt->rowCount();

			return $count;
		}

	}