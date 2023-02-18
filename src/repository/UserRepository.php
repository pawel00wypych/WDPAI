<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function userExists(string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users LEFT JOIN user_details 
            ON users.id_user_details = user_details.id_user_details WHERE email = :email
        ');

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        return true;
    }
    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users LEFT JOIN user_details 
            ON users.id_user_details = user_details.id_user_details WHERE email = :email
        ');

        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('User not found.');
        }

        return new User(
            $user['email'],
            $user['user_password'],
            $user['user_name'],
            $user['surname'],
            $user['salt'],
            $user['id_role'],
            $user['phone'],
            $user['id_user'],
            $user['created_at']
        );
    }

    public function addUser(TempUser $user)
    {
        $date = new DateTime();

        $stmt1 = $this->database->connect()->prepare('
            INSERT INTO user_details (user_name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt1->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (id_role, email, user_password, id_user_details, salt, created_at)
            VALUES (?, ?, ?, ?, ?, ?) RETURNING id_user, created_at
        ');

        $stmt->execute([
            $user->getRole(),
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $user->getSalt(),
            $date->format("Y-m-d")
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserDetailsId(TempUser $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_details WHERE user_name = :user_name AND surname = :surname AND phone = :phone
        ');
        $name = $user->getName();
        $stmt->bindParam(':user_name', $name);
        $surname = $user->getSurname();
        $stmt->bindParam(':surname', $surname);
        $phone = $user->getPhone();
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id_user_details'];
    }

    public function getUsers(): array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users 
                inner join user_details ud on ud.id_user_details = users.id_user_details 
                inner join role r on r.id_role = users.id_role;
        ');
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}