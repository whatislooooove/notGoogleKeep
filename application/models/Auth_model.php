<?php

class Auth_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	public function signin($login, $password)
	{
		$this->load->database();
	}
}
