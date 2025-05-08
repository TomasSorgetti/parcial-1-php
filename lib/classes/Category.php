<?php

class Category
{
    private $id;
    private $name;
    private $background;
    private $svg;
    private $path;

    /** 
     * 
     */
    public static function getAllCategories()
    {
        $categoriesData = json_decode(file_get_contents("lib/data/categories.json"), true);

        $categories = [];

        foreach ($categoriesData as $category) {
            //? deberia retornar un error si no encuentra nada
            $newCategory = new self();
            $newCategory->id = $category["id"];
            $newCategory->name = $category["name"];
            $newCategory->background = $category["background"];
            $newCategory->svg = $category["svg"];
            $newCategory->path = $category["path"];

            $categories[] = $newCategory;
        }

        return $categories;
    }

    public static function getCategoryByName($categoryName)
    {
        // TODO => usar el metodo getAllCategories() y filtrarlo en vez de leer el archivo de nuevo y crear una nueva instancia de Category (creo)

        $categoriesData = json_decode(file_get_contents("lib/data/categories.json"), true);

        foreach ($categoriesData as $category) {
            if ($category["name"] === intval($categoryName)) {
                $newCategory = new self();
                $newCategory->id = $category["id"];
                $newCategory->name = $category["name"];
                $newCategory->background = $category["background"];
                $newCategory->svg = $category["svg"];
                $newCategory->path = $category["path"];

                return $newCategory;
            }
        }

        return null;
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
     * Get the value of background
     */
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set the value of background
     *
     * @return  self
     */
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }

    /**
     * Get the value of svg
     */
    public function getSvg()
    {
        return $this->svg;
    }

    /**
     * Set the value of svg
     *
     * @return  self
     */
    public function setSvg($svg)
    {
        $this->svg = $svg;

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
