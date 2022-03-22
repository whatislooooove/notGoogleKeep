<?php


class NoteList_model extends CI_Model
{
	public function add($data) :?bool {
		$this->load->database();

		$data['id_user'] = '1';
		$data['id_note_group'] = '1';
		$data['id_img'] = '1';
		$data['favourite'] = '0';
		$data['date_insert'] = time();
		$data['date_update'] = time();
		$data['date_end'] = time() + 3 * 60 * 60 * 24;

		if (!$this->db->insert('note', $data)) {
			return false;
		}

		return true;
	}

	public function delete($id) :?bool {
		$this->load->database();

		if (!$this->db->delete('note', ['id_note' => $id])) {
			return false;
		}

		return true;
	}

	public function get_notes() :?array {
		$this->load->database();
		$res = $this->db->get('note')->result_array();


		return $res;
	}
}
