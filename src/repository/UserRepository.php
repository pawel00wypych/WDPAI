<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{

    public function userExists(string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM "user" LEFT JOIN user_details 
            ON "user".id_user_details = user_details.id_user_details WHERE email = :email
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
            SELECT * FROM "user" LEFT JOIN user_details 
            ON "user".id_user_details = user_details.id_user_details WHERE email = :email
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
            $user['id_role']
        );
    }

    public function addUser(User $user)
    {
        $date = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (user_name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO "user" (id_role, email, user_password, id_user_details, salt, created_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user->getRole(),
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user),
            $user->getSalt(),
            $date->format("Y-m-d")
        ]);
    }

    public function getUserDetailsId(User $user): int
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
        $result = [];

            $stmt = $this->database->connect()->prepare('
                SELECT * FROM "user";
            ');
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $u) {

                $details = $this->database->connect()->prepare('
                    SELECT * FROM user_details WHERE id_user_details = :id_user_details
                ');

                $id = $u['id_user_details'];
                $details->bindParam(':id_user_details', $id);
                $details->execute();

                $data = $details->fetch(PDO::FETCH_ASSOC);

                 $nu = new User(
                    $u['email'],
                    $u['user_password'],
                    $data['user_name'],
                    $data['surname'],
                    $u['salt'],
                    $u['id_role']
                );

                $nu->setCreatedAt($u['created_at']);
                $nu->setPhone($data['phone']);

                $result[] = $nu;
            }

        return $result;
    }

}