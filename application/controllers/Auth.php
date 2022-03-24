<?php

/**
 * Class Auth
 * Собственно, класс для авторизации
 */
class Auth extends CI_Controller
{
	public function index($logout=false) {
		session_start();
		$this->load->model('notelist_model');

		$this->load->view('templates/header');
		if (array_key_exists('is_authorized', $_SESSION) && !$logout) {
			$data['user_name'] = $_SESSION['user_name'];
			$data['notes'] = $this->notelist_model->get_notes();
			$this->load->view('notelist/home', $data);
		}
		else {
			session_destroy();
			session_unset();
			$logout = false;
			$this->load->view('auth/signin');
		}
		$this->load->view('templates/footer');
	} //signin page

	public function register() {
		$this->load->view('templates/header');
		$this->load->view('auth/signup');
		$this->load->view('templates/footer');
	} //signup page

	public function logout() {
		$this->index(true);
	}

	public function signin() { //signin process
		$this->load->model('auth_model');

		$response = [];
		$decodedPost = json_decode(file_get_contents('php://input'), true);
		if (count($decodedPost) === 0) {
			$response['errors'][] = 'bad=(';
		}
		else {
			$login = htmlspecialchars($decodedPost['login']);
			$pass = htmlspecialchars($decodedPost['password']);

			if (array_key_exists('user_name', $auth = $this->auth_model->signin($login, $pass))) {
				session_start();
				$response['success'] = 'Authorization successfully finished';
				$_SESSION['is_authorized'] = true;
				$_SESSION['user_name'] = $auth['user_name'];
			}
			else {
				$response['errors'][] = 'Неправильный логин или пароль';
			}
		}

		$this->output->set_output(json_encode($response));
	} //signin process

	public function signup() {
		$this->load->model('auth_model');

		$response = [];
		$decodedPost = json_decode(file_get_contents('php://input'), true);
		if (count($decodedPost) === 0) {
			$response['errors'][] = 'bad=(';
		}
		else {
			$name = htmlspecialchars($decodedPost['name']);
			$login = htmlspecialchars($decodedPost['login']);
			$pass = htmlspecialchars($decodedPost['password']);

			if ($this->auth_model->isuserexist($login)) {
				$response['errors'][] = 'Пользователь с таким логином уже существует';
			}

			if (!$this->auth_model->signup($name, $login, $pass)) {
				$response['errors'][] = 'Ошибка в бд';
			}
		}

		$this->output->set_output(json_encode($response));
	} //signup process

	public function isUserExist($login) {
		$this->load->model('auth_model');

		$response = [];

		if (is_null($login)) {
			$response['errors'][] = 'bad=(';
		}
		else {
			if ($this->auth_model->isuserexist($login)) {
				$response['error'] = 'Пользователь с таким логином уже существует';
			}
		}

		$this->output->set_output(json_encode($response));
	}
}
