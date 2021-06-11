<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . "/model/note.php";

	class NoteController
	{
		private static $instanse = null;

		public static function getInstance()
		{
			if(!self::$instanse)
			{
				self::$instanse = new NoteController();
			}

			return self::$instanse;
		}

		public function selectById($id, $id_user)
		{
			return Note::getInstance()->selectById($id, $id_user);
		}

		public function selectByIdUser($id_user)
		{
			return Note::getInstance()->selectByIdUser($id_user);
		}

		public function create($user_id, $title_create_note, $body_create_note, $date_current)
		{
			return Note::getInstance()->create($user_id, $title_create_note, $body_create_note, $date_current);
		}

		public function update($body_edit_note, $title_edit_note, $id_user, $id_edit_note)
		{
			return Note::getInstance()->update($body_edit_note, $title_edit_note, $id_user, $id_edit_note);
		}

		public function checkNote($id_user, $id_edit_note)
		{
			return Note::getInstance()->checkNote($id_user, $id_edit_note);
		}

		public function insert_id()
		{
			return Note::getInstance()->insert_id();
		}

		public function delete($id_user, $id_edit_note)
		{
			return Note::getInstance()->delete($id_user, $id_edit_note);
		}
	}