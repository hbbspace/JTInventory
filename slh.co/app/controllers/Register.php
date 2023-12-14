<?php

class Register extends Controller {
    public function index() {
        $data['title'] = 'Register';

        $this->view('User_View/register/index', $data);
    }
}