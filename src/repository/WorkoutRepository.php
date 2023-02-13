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
            SELECT * FROM workout inner join workout_exercise we on workout.id_workout = we.id_workout  WHERE id_user = :id_user
        ');

        $id = $user->getId();
        $stmt->bindParam(':id_user', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExercises($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT exercise.* 
            FROM exercise WHERE
                id_exercise IN (SELECT workout_exercise.id_exercise FROM workout_exercise  WHERE                               
                id_workout IN (SELECT id_workout FROM workout WHERE workout.id_user = :id_user))
        ');

        $id = $user->getId();
        $stmt->bindParam(':id_user', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC,);
    }

    public function getSets($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT exercise_set.* 
            FROM exercise_set WHERE
                id_exercise IN (SELECT id_exercise FROM exercise WHERE 
                id_exercise IN (SELECT id_exercise FROM workout_exercise WHERE
                id_workout IN (SELECT id_workout FROM workout WHERE workout.id_user = :id_user)))
                
        ');

        $id = $user->getId();
        $stmt->bindParam(':id_user', $id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}