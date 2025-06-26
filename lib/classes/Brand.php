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
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para crear una marca.");

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
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para modificar una marca.");

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
        // TODO => cambiar a metodo estatico

        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para eliminar una marca.");

        $query = 'DELETE FROM brand WHERE id = :id';
        $params = ['id' => $this->id];

        try {
            Database::execute($query, $params);
        } catch (PDOException $error) {
            if (strpos($error->getMessage(), 'foreign key constraint fails') !== false) {
                throw new Exception("la Marca está asociada a uno o más productos.");
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
