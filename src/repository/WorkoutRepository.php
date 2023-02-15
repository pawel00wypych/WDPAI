<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class WorkoutRepository extends Repository
{

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

    public function saveWorkout(string $body, $user)
    {
        $decoded = json_decode($body, true);
        $stmt = $this->database->connect()->prepare('
            INSERT INTO workout(id_user, description, workout_name, total_time, total_hsr, total_volume, total_reps, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?) RETURNING id_workout
        ');



        $created = new DateTime();
        try {
            $stmt->execute([
                $user->getId(),
                $decoded["workout"]["description"],
                $decoded["workout"]["workout_name"],
                $decoded["workout"]["total_time"],
                $decoded["workout"]["total_hsr"],
                $decoded["workout"]["total_volume"],
                $decoded["workout"]["total_reps"],
                $created->format("Y-m-d")
            ]);

            $workoutID = $stmt->fetchColumn();

            foreach ($decoded["exercises"] as $exercise) {

                $stmt2 = $this->database->connect()->prepare('
                    INSERT INTO exercise(id_user, exercise_name, total_hsr, total_reps, total_volume, created_at, break) 
                    VALUES (?, ?, ?, ?, ?, ?, ?) RETURNING id_exercise
                ');

                $stmt2->execute([
                    $user->getId(),
                    $exercise["exercise_name"],
                    $exercise["total_hsr"],
                    $exercise["total_reps"],
                    $exercise["total_volume"],
                    $created->format("Y-m-d"),
                    $exercise["break"]
                ]);

                $exerciseID = $stmt2->fetchColumn();

                $stmt3 = $this->database->connect()->prepare('
                    INSERT INTO workout_exercise(id_workout, id_exercise) 
                    VALUES (?, ?)
                ');

                $stmt3->execute([
                    $workoutID,
                    $exerciseID
                ]);

                foreach ($decoded["sets"] as $set) {
                    if($set["exercise_name"] == $exercise["exercise_name"]) {
                        $stmt4 = $this->database->connect()->prepare('
                    INSERT INTO exercise_set(id_exercise, reps, rir, rpe, weight) 
                    VALUES (?, ?, ?, ?, ?)
                    ');

                        $stmt4->execute([
                            $exerciseID,
                            $set["reps"],
                            $set["rir"],
                            $set["rpe"],
                            $set["weight"]
                        ]);
                    }
                }
            }

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}