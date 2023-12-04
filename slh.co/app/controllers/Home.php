<?php

class Home extends Controller {
	public function index() {
		$data['title'] = 'Halaman Home';

		$this->view('login/login', $data);
	}
}