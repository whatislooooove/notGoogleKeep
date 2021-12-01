<?php

/**
 * Class Auth
 * Собственно, класс для авторизации
 */
class Auth extends CI_Controller
{
	public function index() {
		session_start();
		$this->load->view('templates/header');
		if (array_key_exists('is_authorized', $_SESSION)) {
			$this->load->view('notelist/home');
		}
		else {
			$this->load->view('auth/signin');
		}
		$this->load->view('templates/footer');
	}

	public function signin() {
		$this->load->model('auth_model');

		$response = [];
		$decodedPost = json_decode(file_get_contents('php://input'), true);
		if (count($decodedPost) === 0) {
			$response['errors'][] = 'bad=(';
		}
		else {
			$login = htmlspecialchars($decodedPost['login']);
			$pass = htmlspecialchars($decodedPost['password']);

			if ($this->auth_model->signin($login, $pass)) {
				$response['success'] = 'Authorization successfully finished';
				$_SESSION['is_authorized'] = true;
			}
			else {
				$response['errors'][] = 'Неправильный логин или пароль';
			}
		}

		$this->output->set_output(json_encode($response));
	}
}
