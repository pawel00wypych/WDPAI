<?php

class User
{

    private string $email;
    private string $password;
    private string $salt;

    private string $name;
    private string $surname;
    private int $phone;
    private int $role;
    private string $created_at;


    public function __construct(string $email,string $password,string $name,string $surname, string $salt, int $role)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->salt = $salt;
        $this->role = $role;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getRole()
    {
        return $this->role;
    }
}