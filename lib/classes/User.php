<?php

class Brand
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $role;

    public static function signup($username, $email, $password)
    {

        $query = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $params = ['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)];

        $user = Database::execute($query, $params, self::class);

        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ];
    }

    public static function signin($email, $password)
    {
        $query = "SELECT * FROM user WHERE email = :email";
        $params = ['email' => $email];

        $user = Database::execute($query, $params, self::class);
        if (empty($user)) {
            return "El email es incorrecto";
        }

        if (!password_verify($password, $user->password)) {
            return "La contraseña es incorrecta";
        }

        return [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email
        ];
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
}
