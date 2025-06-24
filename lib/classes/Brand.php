<?php

class Brand
{
    private $id;
    private $name;


    public static function getAllBrands(): array
    {
        $query = 'SELECT * FROM brand';

        return Database::execute($query, [], self::class);
    }

    public static function getBrandById($brandId): self
    {
        $query = 'SELECT * FROM brand WHERE id = :id';
        $params = ['id' => $brandId];

        return Database::execute($query, $params, self::class)[0];
    }

    public static function insertBrand($name): void
    {
        $query = 'INSERT INTO brand (name) VALUES (:name)';
        $params = ['name' => $name];

        Database::execute($query, $params, self::class);
    }

    public static function updateBrand($brandId, $brandName): void
    {
        $query = 'UPDATE brand SET name = :name WHERE id = :id';
        $params = ['name' => $brandName, 'id' => $brandId];

        Database::execute($query, $params);
    }

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
