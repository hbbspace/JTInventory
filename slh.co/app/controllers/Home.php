<?php

class Home extends Controller {
	public function index() {
		$data['title'] = 'Home';
		$data['level'] = 'Teknisi';
		$id = $_SESSION['user_id'];

		//$data['nama'] = $this->model('User_model')->getUser();

		$this->view('templates/top', $data);
		$this->view('templates/sideMenuAdmin');
		$this->view('home/index', $data);
		$this->view('templates/bottom');
	}
}