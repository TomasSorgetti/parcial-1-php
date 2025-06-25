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
        $query = 'UPDATE tag SET name = :name WHERE id = :id';
        $params = ['name' => $tagName, 'id' => $tagId];

        Database::execute($query, $params, self::class);
    }

    /**
     * Elimina un tag de la base de datos.
     *
     * @return void
     */
    public function deleteTag(): void
    {
        $query = 'DELETE FROM tag WHERE id = :id';
        $params = ['id' => $this->id];

        Database::execute($query, $params);
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
