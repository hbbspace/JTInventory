<?php

class History extends Controller {

    public function index() {
        $data['title'] = 'History';
        $data['history']=$this->model('History_Model')->getAllHistory();

        $this->view('templates/header');
		$this->view('templates/menu');
        $this->view('history/index', $data);
        $this->view('templates/footer');
    }

}