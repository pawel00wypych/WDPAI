<?php

require_once __DIR__.'/TempUser.php';
class User extends TempUser
{
    private $created_at;

    private $id;


    public function __construct(string $email,string $password,string $name,string $surname, string $salt, int $role, int $phone, int $id, string $date)
    {
        parent::__construct( $email, $password, $name, $surname,  $salt,  $role, $phone);
        $this->id =  $id;
        $this->created_at = $date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }
}