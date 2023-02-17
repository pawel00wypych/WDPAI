<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('main_page', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::get('summary', 'SecurityController');
Routing::get('add_workout', 'WorkoutController');
Routing::get('add_exercise', 'WorkoutController');
Routing::get('add_routine', 'SecurityController');
Routing::get('workout_history', 'SecurityController');
Routing::get('settings', 'SecurityController');
Routing::get('getUsers', 'SecurityController');
Routing::get('getWorkouts', 'WorkoutController');
Routing::get('getExercises', 'WorkoutController');
Routing::get('getSetsOfExercise', 'WorkoutController');
Routing::get('getStatistics', 'WorkoutController');
Routing::get('getWorkoutVolumes', 'WorkoutController');
Routing::post('saveWorkout', 'WorkoutController');
Routing::post('logout', 'SecurityController');

Routing::run($path);