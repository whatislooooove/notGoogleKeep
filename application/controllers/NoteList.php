<?php

/**
 * Class NoteList
 * Класс для отображения заметок на лк
 */
class NoteList extends CI_Controller
{
	public function view($page = 'home') {
		if (!file_exists(APPPATH.'/views/notelist/'.$page.'.php'))
		{
			show_404();
		}

		$this->load->model('notelist_model');

		$data['title'] = ucfirst($page); // Capitalize the first letter
		$data['notes'] = $this->notelist_model->get_notes();

		$this->load->view('templates/header', $data);
		$this->load->view('notelist/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}

	public function add() {
		$this->load->model('notelist_model');
		$decodedPost = json_decode(file_get_contents('php://input'), true);

		$response['success'] = 'Note successfully added';
		if (count($decodedPost) !== 0) {
			if (!$this->notelist_model->add($decodedPost)) {
				$response['errors'][] = 'Something wrong. Note was not added';
			}
		}
	}

	public function delete() {
		$this->load->model('notelist_model');
		$id = json_decode(file_get_contents('php://input'), true);

		$response['success'] = 'Note successfully deleted';
		if (is_numeric($id)) {
			if (!$this->notelist_model->delete($id)) {
				$response['errors'][] = 'Something wrong. Note was not deleted';
			}
		}
	}
}
