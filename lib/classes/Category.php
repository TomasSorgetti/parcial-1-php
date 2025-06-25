<?php

class Category
{
    private $id;
    private $name;
    private $path;


    /**
     * Obtiene todas las categorías de la base de datos.
     *
     * @return array Lista de objetos Category.
     */
    public static function getAllCategories(): array
    {
        $query = 'SELECT * FROM category';

        return Database::execute($query, [], self::class);
    }

    /**
     * Obtiene una categoría por su ID.
     *
     * @param int $categoryId ID de la categoría.
     * @return self Instancia de la categoría encontrada.
     */
    public static function getCategoryById(int $categoryId): self
    {
        $query = 'SELECT * FROM category WHERE id = :id';
        $params = ['id' => $categoryId];

        return Database::execute($query, $params, self::class)[0];
    }

    /**
     * Obtiene una categoría por su nombre.
     *
     * @param string $categoryName Nombre de la categoría.
     * @return self Instancia de la categoría encontrada.
     */
    public static function getCategoryByName(string $categoryName): self
    {
        $query = 'SELECT * FROM category WHERE name = :name';
        $params = ['name' => $categoryName];

        return Database::execute($query, $params, self::class);
    }

    /**
     * Inserta una nueva categoría en la base de datos.
     *
     * @param string $name Nombre de la categoría.
     * @param string $path Ruta de la categoría.
     * @return void
     */
    public static function insertCategory(string $name, string $path): void
    {
        $query = 'INSERT INTO category (name, path) VALUES (:name, :path)';
        $params = ['name' => $name, 'path' => $path];

        Database::execute($query, $params, self::class);
    }

    /**
     * Actualiza una categoría existente.
     *
     * @param int $categoryId ID de la categoría a actualizar.
     * @param string $categoryName Nuevo nombre de la categoría.
     * @param string $categoryPath Nueva ruta de la categoría.
     * @return void
     */
    public static function updateCategory(int $categoryId, string $categoryName, string $categoryPath): void
    {
        $query = 'UPDATE category SET name = :name, path = :path WHERE id = :id';
        $params = ['name' => $categoryName, 'path' => $categoryPath, 'id' => $categoryId];

        Database::execute($query, $params);
    }

    /**
     * Elimina una categoría de la base de datos.
     *
     * @return void
     */
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
