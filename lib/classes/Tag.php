<?php

class Tag
{
    private $id;
    private $name;


    /**
     * Obtiene todos los tags de la base de datos.
     *
     * @return array Lista de objetos Tag.
     */
    public static function getAllTags(): array
    {
        $query = 'SELECT * FROM tag';

        return Database::execute($query, [], self::class);
    }

    /**
     * Obtiene un tag por su ID.
     *
     * @param int $tagId ID del tag.
     * @return self Instancia del tag encontrado.
     */
    public static function getTagById($tagId): self
    {
        $query = 'SELECT * FROM tag WHERE id = :id';
        $params = ['id' => $tagId];

        return Database::execute($query, $params, self::class)[0];
    }

    /**
     * Inserta un nuevo tag en la base de datos.
     *
     * @param string $name Nombre del tag.
     * @return void
     */
    public static function insertTag($name): void
    {
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para crear tags.");

        $query = 'INSERT INTO tag (name) VALUES (:name)';
        $params = ['name' => $name];

        Database::execute($query, $params, self::class);
    }

    /**
     * Actualiza el nombre de un tag existente.
     *
     * @param int $tagId ID del tag a actualizar.
     * @param string $tagName Nuevo nombre del tag.
     * @return void
     */
    public static function updateTag($tagId, $tagName): void
    {
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para modificar tags.");

        $query = 'UPDATE tag SET name = :name WHERE id = :id';
        $params = ['name' => $tagName, 'id' => $tagId];

        Database::execute($query, $params, self::class);
    }

    /**
     * Elimina un tag de la base de datos.
     *
     * @return void
     */
    public static function deleteTag(string $tagId): void
    {
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para eliminar tags.");

        $query = 'DELETE FROM tag WHERE id = :id';
        $params = ['id' => $tagId];

        try {
            Database::execute($query, $params);
        } catch (PDOException $error) {
            if (strpos($error->getMessage(), 'foreign key constraint fails') !== false) {
                throw new Exception("la Etiqueta está asociada a uno o más productos.");
            }
            throw $error;
        }
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
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
