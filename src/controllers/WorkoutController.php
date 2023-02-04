<?php

require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Workout.php';
require_once __DIR__.'/../repository/UserRepository.php';
class WorkoutController extends DefaultController
{

    private $workoutRepository;

    public function __construct()
    {
        parent::__construct();
        $this->workoutRepository = new WorkoutRepository();
    }


    public function add_workout() {

        if ($this->isPost() && $this->validate($_POST[])) {

            // TODO create new project object and save it in database
            $workout = new Workout($_POST['title'], $_POST['description'], $_FILES['file']['name']);
            $this->workoutRepository->addWorkout($workout);

            return $this->render('workout_history', [
                'messages' => $this->message,
                'projects' => $this->workoutRepository->getWorkouts()
            ]);
        }

        $this->render('add_workout');

    }

    public function add_exercise() {



        $this->render('add_exercise');
    }

    private function validate($post): bool
    {
        if (!isset($post['workout_name'])) {
            $this->message[] = 'Workout name can\'t be null';
            return false;
        }

        if (strlen($post['workout_name']) > 0) {
            $this->message[] = 'Workout name can\'t be empty';
            return false;
        }

        return true;
    }
}