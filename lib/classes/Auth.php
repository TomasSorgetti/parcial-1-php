<?php

class Auth
{

    public static function signin($email, $password)
    {
        $user = User::getUser($email);

        if (!$user) {
            throw new Exception("El usuario no existe.");
        }

        $isPassowrdValid = password_verify($password, $user->getPassword());

        if (!$isPassowrdValid) {
            throw new Exception("La contraseña es incorrecta.");
        }

        $sessionData = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role' => $user->getRole()
        ];

        $_SESSION['session'] = $sessionData;

        return $sessionData;
    }

    public static function signup($username, $email, $password)
    {
        $foundUser = User::getUser($email);

        if ($foundUser) {
            throw new Exception("El email ya está en uso.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // NOTA: el role esta por defecto como user

        $query = 'INSERT INTO user (username, email, password) VALUES (:username, :email, :password)';

        $params = ['username' => $username, 'email' => $email, 'password' => $hashedPassword];

        Database::execute($query, $params, User::class);
    }

    public static function logout()
    {
        if (isset($_SESSION['session'])) {
            unset($_SESSION['session']);
        }
    }

    public static function verify($level = 0): bool
    {
        if (!$level) {
            return false;
        }

        if (isset($_SESSION['session'])) {
            if ($_SESSION['session']['role'] === "admin" || $_SESSION['session']['role'] === "superadmin") {
                return true;
            }
        }

        return false;
    }
}
