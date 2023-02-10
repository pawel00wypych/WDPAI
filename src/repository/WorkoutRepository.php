<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class WorkoutRepository extends Repository
{


    public function addWorkout(Workout $workout)
    {

    }

    public function getWorkouts($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM workout w LEFT JOIN workout_exercise ON w.id_workout = workout_exercise.id_workout
                left join exercise e on e.id_exercise = workout_exercise.id_exercise 
                     left outer join exercise_set es on e.id_exercise = es.id_exercise WHERE w.id_user = :id_user
        ');

        $id = $user->getId();
        $stmt->bindParam(':id_user', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}