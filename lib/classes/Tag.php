<?php

class Tag
{
    private $id;
    private $name;


    public static function getAllTags(): array
    {
        $query = 'SELECT * FROM tag';

        return Database::execute($query, [], self::class);
    }

    public static function getTagById($tagId): self
    {
        $query = 'SELECT * FROM tag WHERE id = :id';
        $params = ['id' => $tagId];

        return Database::execute($query, $params, self::class)[0];
    }

    public static function insertTag($name): void
    {
        $query = 'INSERT INTO tag (name) VALUES (:name)';
        $params = ['name' => $name];

        Database::execute($query, $params, self::class);
    }

    public static function updateTag($tagId, $tagName): void
    {
        $query = 'UPDATE tag SET name = :name WHERE id = :id';
        $params = ['name' => $tagName, 'id' => $tagId];

        Database::execute($query, $params, self::class);
    }

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
