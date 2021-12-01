<?php

class Auth_model extends CI_Model {
//	public function __construct()
//	{
//		parent::__construct();
//	}

	public function signin($login, $password): ?bool
	{
		$data = ['login' => $login];
		$this->load->database();
		$users = $this->db
			->where($data)
			->get('user')
			->row_array();

		if ((is_null($users)) || (count($users) === 0)) {
			return false;
		}

		if (password_verify($password, $users['password'])) {
			return true;
		}

		return false;
	}
}
