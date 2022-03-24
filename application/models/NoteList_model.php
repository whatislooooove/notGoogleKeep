<?php


class NoteList_model extends CI_Model
{
	public function add($data) :?array {
		session_start();
		$this->load->database();

		$data['id_user'] = $_SESSION['id_user'];
		$data['id_note_group'] = '1';
		$data['id_img'] = '1';
		$data['favourite'] = '0';
		$data['date_insert'] = time();
		$data['date_update'] = time();
		$data['date_end'] = time() + 3 * 60 * 60 * 24;

		if (!$this->db->insert('note', $data)) {
			$data['error'] = 'Не удалось добавить запись';
			return $data;
		}

		return $data;
	}

	public function delete($id) :?bool {
		$this->load->database();

		if (!$this->db->delete('note', ['id_note' => $id])) {
			return false;
		}

		return true;
	}

	public function get_notes($login) :?array {
		$this->load->database();
		$res = $this->db
			->join('user', 'user.id_user = note.id_user')
			->where('user.login', $login)
			->get('note')->result_array();

		return $res;
	}

	public function get_note($login) :?array {
		$this->load->database();
		$res = $this->db
			->join('user', 'user.id_user = note.id_user')
			->where('user.login', $login)
			->get('note')->result_array();

		return $res;
	}
}
