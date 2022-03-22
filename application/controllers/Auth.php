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
	}

	public function logout() {
		$this->index(true);
	}
}
