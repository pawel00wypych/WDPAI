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
            $user->getEmail()." ".
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

        list(,, $hashed_secret_word) = explode(' ',$_COOKIE['user']);
        if (password_verify($this->secret_word, $hashed_secret_word)) {
             return true;
         }

        return false;
    }

    public function summary() {

        if(isset($_COOKIE['user']) && $this->validate_cookie())
            $this->render('summary');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function add_routine() {

        if(isset($_COOKIE['user']) && $this->validate_cookie())
            $this->render('add_routine');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function workout_history() {

        if(isset($_COOKIE['user']) && $this->validate_cookie())
            $this->render('workout_history');
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }

    }

    public function settings()
    {
        list(,$cookie_email,) = explode(' ',$_COOKIE['user']);
        $role = $this->userRepository->getUser($cookie_email)->getRole();

        if (isset($_COOKIE['user']) && $this->validate_cookie() && ($role === 2))
            $this->render('admin_settings', ['users' => '']);
        else if (isset($_COOKIE['user']) && $this->validate_cookie() && ($role === 1))
            $this->render('settings');
        else
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function getUsers() {
        if (isset($_COOKIE['user']))
        {
            $users = $this->userRepository->getUsers();
            $this->render('admin_settings', ['users' => $users]);
        }else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location:$url/login");
        }
    }

    public function logout() {

        if (isset($_COOKIE["user"]) && $this->validate_cookie()){
            setcookie("user", '', time() - (180));
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location:$url/login");
    }

}