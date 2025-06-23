<?php

class Category
{
    private $id;
    private $name;
    private $path;

    /** 
     * 
     */
    public static function getAllCategories()
    {
        $query = 'SELECT * FROM category';

        return Database::execute($query, [], self::class);
    }

    public static function getCategoryByName($categoryName)
    {
        $query = 'SELECT * FROM category WHERE name = :name';
        $params = ['name' => $categoryName];

        return Database::execute($query, $params, self::class);
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
