<?php

class Brand
{
    private $id;
    private $name;


    /**
     * Obtiene todas las marcas de la base de datos.
     *
     * @return array Lista de objetos Brand.
     */
    public static function getAllBrands(): array
    {
        $query = 'SELECT * FROM brand';

        return Database::execute($query, [], self::class);
    }

    /**
     * Obtiene una marca por su ID.
     *
     * @param int $brandId ID de la marca.
     * @return self Instancia de la marca encontrada.
     */
    public static function getBrandById(int $brandId): self
    {
        $query = 'SELECT * FROM brand WHERE id = :id';
        $params = ['id' => $brandId];

        return Database::execute($query, $params, self::class)[0];
    }

    /**
     * Inserta una nueva marca en la base de datos.
     *
     * @param string $name Nombre de la marca.
     * @return void
     */
    public static function insertBrand(string $name): void
    {
        $query = 'INSERT INTO brand (name) VALUES (:name)';
        $params = ['name' => $name];

        Database::execute($query, $params, self::class);
    }

    /**
     * Actualiza el nombre de una marca existente.
     *
     * @param int $brandId ID de la marca a actualizar.
     * @param string $brandName Nuevo nombre de la marca.
     * @return void
     */
    public static function updateBrand(int $brandId, string $brandName): void
    {
        $query = 'UPDATE brand SET name = :name WHERE id = :id';
        $params = ['name' => $brandName, 'id' => $brandId];

        Database::execute($query, $params);
    }

    /**
     * Elimina una marca de la base de datos.
     *
     * @return void
     */
    public function deleteBrand(): void
    {
        $query = 'DELETE FROM brand WHERE id = :id';
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
