<?php

class Product
{
    private $id;
    private $id_category;
    private $id_brand;
    private $title;
    private $image;
    private $description;
    private $stock;
    private $price;
    private $offer_price;

    /**
     * Obtiene todos los productos con filtros, ordenamiento y paginación
     * @param string $search Término de búsqueda
     * @param string $categoryQuery ID de categoría o 'all'
     * @param string $orderQuery Orden: price_asc, price_desc, name_asc, name_desc
     * @param int $pageQuery Página actual
     * @param int $prodPerPage Productos por página
     * @return array
     */
    public static function getAllProducts(string $search = "", string $categoryQuery = "all", string $orderQuery = "price_asc", int $pageQuery = 1, int $prodPerPage = 9): array
    {
        // NOTA => No vuelvo a hacer paginación en mi vida.

        // TODO => El search hace la busqueda con la categoria, deberia hacer la busqueda reseteando todo el query. Estoy cansado jefe....

        $query = "SELECT product.* 
                  FROM product";
        $params = [];
        $conditions = [];

        if ($search !== "") {
            $conditions[] = "product.title LIKE :search";
            $params['search'] = '%' . htmlspecialchars($search) . '%';
        }

        if ($categoryQuery !== "all") {
            $conditions[] = "product.id_category = :category";
            $params['category'] = (int)$categoryQuery;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        switch ($orderQuery) {
            case "price_asc":
                $query .= " ORDER BY product.price ASC";
                break;
            case "price_desc":
                $query .= " ORDER BY product.price DESC";
                break;
            case "name_asc":
                $query .= " ORDER BY product.title ASC";
                break;
            case "name_desc":
                $query .= " ORDER BY product.title DESC";
                break;
            default:
                $query .= " ORDER BY product.price ASC";
                break;
        }

        $countQuery = str_replace("SELECT product.*", "SELECT COUNT(*) AS total", $query);
        $totalProducts = Database::execute($countQuery, $params)[0]['total'];

        $limit = (int)$prodPerPage;
        $offset = (int)(($pageQuery - 1) * $prodPerPage);

        // TODO => falla el limit y offset, llega como string al query final
        $query .= " LIMIT $limit OFFSET $offset";

        $products = Database::execute($query, $params, self::class);

        return [
            "total_pages" => ceil($totalProducts / $prodPerPage),
            "current_page" => $pageQuery,
            "products" => $products,
            "total_products" => $totalProducts
        ];
    }

    /**
     * Obtiene un producto por su ID
     * @param string $id
     * @return Product|null
     */
    public static function getProductById(string $id): ?self
    {
        $query = "SELECT * FROM product WHERE id = :id";
        $params = ['id' => (int)$id];

        $results = Database::execute($query, $params, self::class);

        if (empty($results)) {
            return null;
        }

        $product = $results[0];

        return $product;
    }

    public static function getProductsByCategory(int $id_category): array
    {
        $query = "SELECT * FROM product WHERE id_category = :id_category";
        $params = ['id_category' => $id_category];
        return Database::execute($query, $params, self::class);
    }

    public function getQuotePrice(int $quote = 12): int
    {
        return $this->price * $quote + ($this->price % $quote > 0 ? 1 : 0);
    }
    /**
     * Obtiene el ID del producto
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Setea el ID del producto
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Obtiene el ID de la categoría
     */
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * Setea el ID de la categoría
     */
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
        return $this;
    }

    /**
     * Obtiene el ID de la marca
     */
    public function getIdBrand()
    {
        return $this->id_brand;
    }

    /**
     * Setea el ID de la marca
     */
    public function setIdBrand($id_brand)
    {
        $this->id_brand = $id_brand;
        return $this;
    }

    /**
     * Obtiene el titulo del producto
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Setea el titulo del producto
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Obtiene la imagen del producto
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Setea la imagen del producto
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Obtiene la descripcion del producto
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Setea la descripcion del producto
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Obtiene el stock del producto
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Setea el stock del producto
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
        return $this;
    }

    /**
     * Obtiene el precio del producto
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Setea el precio del producto
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Obtiene el precio de oferta del producto
     */
    public function getOfferPrice()
    {
        return $this->offer_price ?? $this->price;
    }

    /**
     * Setea el precio de oferta del producto
     */
    public function setOfferPrice($offer_price)
    {
        $this->offer_price = $offer_price;
        return $this;
    }

    /**
     * Obtiene la categoría del producto
     */
    public function getCategory()
    {
        $category = (new Category())->getCategoryById($this->id_category);

        return $category->getName();
    }
}
