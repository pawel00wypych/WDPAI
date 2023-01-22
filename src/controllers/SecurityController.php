<?php

require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends DefaultController
{


    public function login()
    {
        $user= new User('jsnow@pk.edu.pl', 'admin', 'Johnny', 'Snow');

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];



        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $cookie_name = "user";
        $cookie_value = "John Snow";

        setcookie($cookie_name, $cookie_value, time() + 180, "/");

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/summary");

    }

    public function register()
    {


    }
}