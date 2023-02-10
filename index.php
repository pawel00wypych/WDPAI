<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('main_page', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::get('summary', 'SecurityController');
Routing::post('add_workout', 'WorkoutController');
Routing::post('add_exercise', 'WorkoutController');
Routing::get('add_routine', 'SecurityController');
Routing::get('workout_history', 'SecurityController');
Routing::get('settings', 'SecurityController');
Routing::get('getUsers', 'SecurityController');
Routing::get('getWorkouts', 'WorkoutController');
Routing::post('logout', 'SecurityController');

Routing::run($path);