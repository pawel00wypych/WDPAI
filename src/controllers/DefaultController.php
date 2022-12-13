<?php

require_once 'AppController.php';

class DefaultController  extends AppController{

    public function index() {

        $this->render('main_page', ['message' => "Hello World"]);
    }

    public function login() {

        $this->render('login');

    }

    public function register() {

        $this->render('register');

    }

    public function summary() {

        $this->render('summary');

    }

    public function addWorkout() {

        $this->render('add_workout');

    }

    public function addExercise() {

        $this->render('add_exercise');

    }

    public function addRoutine() {

        $this->render('add_routine');

    }

    public function workout_history() {

        $this->render('workout_history');

    }

}