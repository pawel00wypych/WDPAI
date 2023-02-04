<?php

require_once 'DefaultController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends DefaultController
{


    private UserRepository $userRepository;

    private string $secret_word = "some GreaT S3Cr3t W0rt";
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }
    public function login()
    {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];


        try {

            $user = $this->userRepository->getUser($email);
        }catch (Exception $e){

            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }


        if(!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['salt'=>$user->getSalt()] );

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if ($user->getPassword() !== $hashedPassword) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }


        $cookie_name = "user";
        $cookie_value = $user->getName()." ".
            $user->getSurname()." ".
            password_hash($this->secret_word, PASSWORD_BCRYPT);

        setcookie($cookie_name, $cookie_value, time() + 180, "/");

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location:$url/summary");

    }

    public function register()
    {

        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $salt = $this->randomSalt();

        if($this->userRepository->userExists($email)) {
            return $this->render('register', ['messages' => ['This email is being used']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['messages' => ['Please provide proper password']]);
        }


        //TODO try to use better hash function
        $user = new User($email, password_hash($password, PASSWORD_BCRYPT, ['salt'=>$salt]), $name, $surname, $salt, 1);
        $user->setPhone($phone);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You\'ve been successfully registered!']]);
    }

    function randomSalt($len = 22): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
	    return $str;
    }

    function validate_cookie(): bool
    {

         list($c_username,$cookie_surname, $hashed_secret_word) = preg_split(' ',$_COOKIE['value']);
         if ($c_username." ".$cookie_surname." ".$hashed_secret_word ===
                $c_username." ".$cookie_surname." ".password_hash($this->secret_word, PASSWORD_BCRYPT)
         )
         {
             return true;
         }

        return false;
    }

    public function summary() {

        if(isset($_COOKIE['user']))
            $this->render('summary');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function add_routine() {

        if(isset($_COOKIE['user']))
            $this->render('add_routine');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function workout_history() {

        if(isset($_COOKIE['user']))
            $this->render('workout_history');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }

    }

    public function settings()
    {
        if (isset($_COOKIE['user']))
            $this->render('settings');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function logout() {

        if (isset($_COOKIE["user"])){
            setcookie("user", '', time() - (180));
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location:$url/login");
    }

}