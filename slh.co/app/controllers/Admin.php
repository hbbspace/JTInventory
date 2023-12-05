<?php

class Admin extends Controller {
    public function index() {
        $data['title'] = 'Home';
        $data['admin']=$this->model('Admin_model')->getAllAdmin();

        $this->view('templates/header', $data);
		$this->view('templates/menu');
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }
}