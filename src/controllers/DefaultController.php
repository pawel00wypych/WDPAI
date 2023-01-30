<?php

require_once 'AppController.php';

class DefaultController  extends AppController{

    public function index() {

        $this->render('main_page');
    }

    public function main_page() {

        $this->render('main_page', ['message' => ""]);
    }

    public function login() {

        $this->render('login');

    }


    public function summary() {

        $this->render('summary');

    }

    public function add_workout() {

        $this->render('add_workout');

    }

    public function add_exercise() {

        $this->render('add_exercise');

    }

    public function add_routine() {

        $this->render('add_routine');

    }

    public function workout_history() {

        $this->render('workout_history');

    }

}