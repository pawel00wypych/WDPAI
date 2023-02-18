<?php

require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Workout.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/WorkoutRepository.php';

class WorkoutController extends DefaultController
{

    private $workoutRepository;

    public function __construct()
    {
        parent::__construct();
        $this->workoutRepository = new WorkoutRepository();
        $this->userRepository = new UserRepository();
        $this->security = new SecurityController();
    }

    public function saveWorkout() {
        if($this->security->validate_cookie()) {
            list(, $email,) = explode(' ', $_COOKIE['user']);
            $user = $this->userRepository->getUser($email);

            $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

            if ($contentType == "application/json") {

                $body = trim(file_get_contents("php://input"));
                $this->render($body);
                $result = $this->workoutRepository->saveWorkout($body, $user);

                header('Content-type: application/json');
                http_response_code(200);
                echo json_encode($result);
            }

            $this->render('add_workout');
        }
    }

    public function add_workout() {
        if($this->security->validate_cookie()) {
            $this->render('add_workout');
        }
    }

    public function add_exercise() {
        if($this->security->validate_cookie()) {

            $this->render('add_exercise');
        }
    }

    public function getWorkouts()
    {
        if($this->security->validate_cookie()) {

            list(, $email,) = explode(' ', $_COOKIE['user']);
            $user = $this->userRepository->getUser($email);

            $workouts = $this->workoutRepository->getWorkouts($user);
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($workouts);
        }
    }

    public function getExercises()
    {
        if($this->security->validate_cookie()) {

            list(, $email,) = explode(' ', $_COOKIE['user']);
            $user = $this->userRepository->getUser($email);

            $exercises = $this->workoutRepository->getExercises($user);
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($exercises);
        }
    }

    public function getSetsOfExercise()
    {
        if($this->security->validate_cookie()) {

            list(, $email,) = explode(' ', $_COOKIE['user']);
            $user = $this->userRepository->getUser($email);

            $sets = $this->workoutRepository->getSets($user);
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($sets);
        }
    }

    public function getStatistics()
    {
        if($this->security->validate_cookie()) {
            list(, $email,) = explode(' ', $_COOKIE['user']);
            $user = $this->userRepository->getUser($email);

            $stats = $this->workoutRepository->getStatistics($user);
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($stats);
        }
    }

    public function getWorkoutVolumes()
    {
        if($this->security->validate_cookie()) {
            list(, $email,) = explode(' ', $_COOKIE['user']);
            $user = $this->userRepository->getUser($email);

            $volumes = $this->workoutRepository->getWorkoutVolumes($user);
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($volumes);
        }
    }
}