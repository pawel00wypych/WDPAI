<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('main_page', 'DefaultController');
Routing::post('login', 'SecurityController');
Routing::post('register', 'SecurityController');
Routing::get('summary', 'DefaultController');
Routing::get('add_workout', 'DefaultController');
Routing::get('add_exercise', 'DefaultController');
Routing::get('add_routine', 'DefaultController');
Routing::get('workout_history', 'DefaultController');
Routing::run($path);