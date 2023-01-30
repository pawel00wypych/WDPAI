<?php

class Database {

    private string $username;
    private string $password;
    private string $host;
    private string $database;

    private static $instance;

    private function __construct()
    {

        $this->username = 'dbuser';

        $this->password = 'dbpwd';

        $this->host = 'db';

        $this->database = 'dbname';

    }

    public function connect()
    {

        try {

            $conn = new PDO(

                "pgsql:host=$this->host;port=5432;dbname=$this->database",

                $this->username,

                $this->password,

                ["sslmode"  => "prefer"]

            );

            // set the PDO error mode to exception

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch(PDOException $e) {

            die("Connection failed: " . $e->getMessage());

        }

    }

    public static function getInstance(): Database
    {
        if(self::$instance == null){
            self::$instance = new Database();
        }
        return self::$instance;
    }

}