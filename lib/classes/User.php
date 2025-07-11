<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public static function isAdmin()
    {
        if (!isset($_SESSION['session']['role'])) return false;

        return in_array($_SESSION['session']['role'], ['admin', 'superadmin']);
    }

    /**
     * Obtiene un usuario por su correo electrónico.
     *
     * @param string $email Correo electrónico del usuario.
     * @return self Instancia del usuario encontrado.
     */
    public static function getUser(string $email, ?string $username = null): self | null
    {
        $query = 'SELECT * FROM user WHERE email = :email';
        $params = ['email' => $email];

        if ($username) {
            $query .= ' OR username = :username';
            $params['username'] = $username;
        }

        return Database::execute($query, $params, self::class)[0] ?? null;
    }

    /**
     * Obtiene todos los usuarios de la base de datos.
     *
     * @return array Lista de objetos User.
     */
    public static function getAllUsers(): array
    {
        // TODO => unicamente el admin deberia poder obtener todos los usuarios
        $query = 'SELECT id, username, email, role FROM user';
        return Database::execute($query, [], self::class);
    }

    /**
     * Actualiza el rol de un usuario por su correo electrónico.
     *
     * @param string $email Correo electrónico del usuario.
     * @param string $role Nuevo rol del usuario.
     * @return void
     */
    public static function updateUser($email, $role) {}

    /**
     * Elimina un usuario de la base de datos (soft delete pendiente).
     *
     * @return void
     * @todo Implementar soft delete en lugar de eliminación total.
     */
    public static function deleteUser(): void
    {
        //TODO => el borrado no debe ser un delete total, sino un soft delete
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
