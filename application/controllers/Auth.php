<?php

/**
 * Class Auth
 * Собственно, класс для авторизации
 */
class Auth extends CI_Controller
{
	public function index() {
		$this->load->view('templates/header');
		$this->load->view('auth/signin');
		$this->load->view('templates/footer');
	}

	public function signin() {
		$response = [];
		$decodedPost = json_decode(file_get_contents('php://input'), true);
		if (count($decodedPost) === 0) {
			$response['error'] = 'bad=(';
		}

		$this->output->set_output(json_encode($response));
	}
}
