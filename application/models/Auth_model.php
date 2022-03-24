<?php

class Auth_model extends CI_Model {
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
			$response['id_user'] = $users['id_user'];
			$response['login'] = $users['login'];
		}
		else {
			$response['is_authorized'] = false;
		}

		return $response;
	}

	public function signup($name, $login, $password): ?bool {

		$data = [
			'name' => $name,
			'login' => $login,
			'password' => password_hash($password, PASSWORD_BCRYPT)
		];

		if (!$this->db->insert('user', $data)) {
			return false;
		}

		return true;
	}

	public function isUserExist($login): ?bool {
		$data = ['login' => $login];
		$this->load->database();
		$user = $this->db
			->where($data)
			->select('login, name')
			->get('user')
			->row_array();

		if (is_array($user)) {
			return true;
		}

		return false;
	}
}
