<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class WorkoutRepository extends Repository
{
    public function getWorkoutVolumes($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT total_volume, created_at FROM schema.workout WHERE id_user = :id_user ORDER BY created_at
        ');

        $userID = $user->getId();
        $stmt->bindParam(':id_user', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWorkouts($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM schema.workout inner join schema.workout_exercise we on workout.id_workout = we.id_workout  WHERE id_user = :id_user
        ');

        $userID = $user->getId();
        $stmt->bindParam(':id_user', $userID);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExercises($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT schema.exercise.* 
            FROM schema.exercise WHERE
                id_exercise IN (SELECT schema.workout_exercise.id_exercise FROM schema.workout_exercise  WHERE                               
                id_workout IN (SELECT id_workout FROM schema.workout WHERE workout.id_user = :id_user))
        ');

        $userID = $user->getId();
        $stmt->bindParam(':id_user', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSets($user)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT schema.exercise_set.* 
            FROM schema.exercise_set WHERE
                id_exercise IN (SELECT id_exercise FROM schema.exercise WHERE 
                id_exercise IN (SELECT id_exercise FROM schema.workout_exercise WHERE
                id_workout IN (SELECT id_workout FROM schema.workout WHERE workout.id_user = :id_user)))
                
        ');

        $userID = $user->getId();
        $stmt->bindParam(':id_user', $userID);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveWorkout(string $body,User $user)
    {
        $decoded = json_decode($body, true);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO schema.workout(id_user, description, workout_name, total_time, total_hsr, total_volume, total_reps, created_at, body_weight) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) RETURNING id_workout
        ');
        $userID = $user->getId();

        $created = new DateTime();
        try {
            $stmt->execute([
                $userID,
                $decoded["workout"]["description"],
                $decoded["workout"]["workout_name"],
                $decoded["workout"]["total_time"],
                $decoded["workout"]["total_hsr"],
                $decoded["workout"]["total_volume"],
                $decoded["workout"]["total_reps"],
                $created->format("Y-m-d"),
                $decoded["workout"]["body_weight"]
            ]);

            $workoutID = $stmt->fetchColumn();

            foreach ($decoded["exercises"] as $exercise) {

                $stmt2 = $this->database->connect()->prepare('
                    INSERT INTO schema.exercise(id_user, exercise_name, total_hsr, total_reps, total_volume, created_at, break) 
                    VALUES (?, ?, ?, ?, ?, ?, ?) RETURNING id_exercise
                ');

                $stmt2->execute([
                    $userID,
                    $exercise["exercise_name"],
                    $exercise["total_hsr"],
                    $exercise["total_reps"],
                    $exercise["total_volume"],
                    $created->format("Y-m-d"),
                    $exercise["break"]
                ]);

                $exerciseID = $stmt2->fetchColumn();

                $stmt3 = $this->database->connect()->prepare('
                    INSERT INTO schema.workout_exercise(id_workout, id_exercise) 
                    VALUES (?, ?)
                ');

                $stmt3->execute([
                    $workoutID,
                    $exerciseID
                ]);

                foreach ($decoded["sets"] as $set) {
                    if($set["exercise_name"] == $exercise["exercise_name"]) {
                        $stmt4 = $this->database->connect()->prepare('
                    INSERT INTO schema.exercise_set(id_exercise, reps, rir, rpe, weight) 
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

    public function getStatistics(?User $user)
    {


        $result = array(4);

        $stmt = $this->database->connect()->prepare('
            SELECT *
            FROM schema.workout WHERE (SELECT MAX(created_at) FROM schema.workout WHERE id_user = :id_user) = created_at                     
              
        ');

        $stmt2 = $this->database->connect()->prepare('
            SELECT COUNT(*) 
            FROM schema.workout WHERE id_user = :id_user;                    
              
        ');

        $stmt3 = $this->database->connect()->prepare('
            SELECT SUM (total_volume) AS volume , SUM (total_reps) AS reps, SUM (total_hsr) AS hsr
            FROM schema.workout
            WHERE  id_user = :id_user;                    
                          
        ');


        $id = $user->getId();
        $stmt->bindParam(':id_user', $id);
        $stmt2->bindParam(':id_user', $id);
        $stmt3->bindParam(':id_user', $id);

        $stmt->execute();
        $stmt2->execute();
        $stmt3->execute();

        $result[0] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result[1] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $result[2] = $stmt3->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}