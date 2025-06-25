<?php

class Auth
{

    /**
     * Inicia sesión verificando email y contraseña.
     *
     * @param string $email Email del usuario.
     * @param string $password Contraseña del usuario.
     * @return array Datos de la sesión del usuario (id, username, email, role) evitando la contraseña.
     * @throws Exception Si el usuario no existe o la contraseña es incorrecta.
     */
    public static function signin(string $email, string $password): array
    {
        $user = User::getUser($email, null);

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

    /**
     * Registra un nuevo usuario.
     *
     * @param string $username Nombre de usuario.
     * @param string $email Email del usuario.
     * @param string $password Contraseña del usuario.
     * @return void
     * @throws Exception Si el email ya está en uso.
     */
    public static function signup(string $username, string $email, string $password): void
    {
        $foundUser = User::getUser($email, $username);

        if ($foundUser && $foundUser->getEmail() === $email) {
            throw new Exception("El email ya está en uso.");
        }
        if ($foundUser && $foundUser->getUsername() === $username) {
            throw new Exception("El nombre de usuario ya esta en uso.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // NOTA: el role esta por defecto como user

        $query = 'INSERT INTO user (username, email, password) VALUES (:username, :email, :password)';

        $params = ['username' => $username, 'email' => $email, 'password' => $hashedPassword];

        Database::execute($query, $params, User::class);
    }

    /**
     * Cierra la sesión del usuario actual.
     *
     * @return void
     */
    public static function logout(): void
    {
        if (isset($_SESSION['session'])) {
            unset($_SESSION['session']);
        }
    }

    /**
     * Verifica si el usuario tiene permisos de administrador.
     *
     * @param int $level Nivel de autorización requerido, 0 por defecto.
     * @return bool True si el usuario tiene permisos de admin o superadmin, en caso contrario False.
     */
    public static function verify(int $level = 0): bool
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
