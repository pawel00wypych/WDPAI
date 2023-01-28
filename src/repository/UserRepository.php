<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user WHERE email = :email
        ');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            throw new Exception('User not found.');
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user_details (user_name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO public.user (email, user_password, id_user_details)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE user_name = :name AND surname = :surname AND phone = :phone
        ');
        $name = $user->getName();
        $stmt->bindParam(':name', $name);
        $surname = $user->getSurname();
        $stmt->bindParam(':surname', $surname);
        $phone = $user->getPhone();
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }
}