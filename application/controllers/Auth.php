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
		$this->load->model('auth_model');

		$response = [];
		$decodedPost = json_decode(file_get_contents('php://input'), true);
		if (count($decodedPost) === 0) {
			$response['errors'][] = 'bad=(';
		}
		else {
			$login = $decodedPost['login'];
			$pass = $decodedPost['password'];

			if ($this->auth_model->signin($login, $pass)) {
				echo 'TRUE';
				//переход на страницу с заметками, также сохранение данных в сессии
			}
			$response['errors'][] = 'Неправильный логин или пароль';
		}

		$this->output->set_output(json_encode($response));
	}
}
