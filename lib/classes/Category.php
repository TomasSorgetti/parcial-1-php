<?php

class Category
{
    private $id;
    private $name;
    private $path;


    public static function getAllCategories(): array
    {
        $query = 'SELECT * FROM category';

        return Database::execute($query, [], self::class);
    }

    public static function getCategoryById($categoryId): self
    {
        $query = 'SELECT * FROM category WHERE id = :id';
        $params = ['id' => $categoryId];

        return Database::execute($query, $params, self::class)[0];
    }

    public static function getCategoryByName($categoryName): self
    {
        $query = 'SELECT * FROM category WHERE name = :name';
        $params = ['name' => $categoryName];

        return Database::execute($query, $params, self::class);
    }

    public static function insertCategory($name, $path): void
    {
        $query = 'INSERT INTO category (name, path) VALUES (:name, :path)';
        $params = ['name' => $name, 'path' => $path];

        Database::execute($query, $params, self::class);
    }

    public function deleteCategory(): void
    {
        $query = 'DELETE FROM category WHERE id = :id';
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

    /**
     * Get the value of path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
