<?php

class Auth_model extends CI_Model {
//	public function __construct()
//	{
//		parent::__construct();
//	}

	public function signin($login, $password): ?array
	{
		$response = [];

		$data = ['login' => $login];
		$this->load->database();
		$users = $this->db
			->where($data)
			->get('user')
			->row_array();

		if ((is_null($users)) || (count($users) === 0)) {
			$response['is_authorized'] = false;
		}

		if (password_verify($password, $users['password'])) {
			$response['is_authorized'] = true;
			$response['user_name'] = $users['name'];
		}
		else {
			$response['is_authorized'] = false;
		}

		return $response;
	}
}
