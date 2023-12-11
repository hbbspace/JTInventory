<?php

class Logout extends Controller {

    public function index() {
        session_destroy();
        header("Location:http://localhost/dasarWeb/JTInventory/slh.co/public/");
    }
}