<?php

require_once 'AppController.php';

class DefaultController  extends AppController{

    public function index() {

        $this->render('main_page');
    }

    public function login() {

        $this->render('login');

    }

}