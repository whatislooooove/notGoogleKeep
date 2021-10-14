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

		$data['title'] = ucfirst($page); // Capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('notelist/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
}
