<?php

class Home extends Controller {
	public function index() {
		$data['title'] = 'Home';
		$data['level'] = 'Teknisi';
		$data['nama'] = 'Habibatul Mustofa';

		//$data['nama'] = $this->model('User_model')->getUser();

		$this->view('templates/header', $data);
		$this->view('templates/menu');
		$this->view('home/index', $data);
		$this->view('templates/footer');
	}
}