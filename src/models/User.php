<?php

class User
{

    private string $email;
    private string $password;
    private string $name;
    private string $surname;
    private int $phone;

    public function __construct(string $email,string $password,string $name,string $surname)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
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

    public function setPhone(mixed $phone): void
    {
        $this->phone = $phone;
    }
}