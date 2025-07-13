<?php

class Product
{
    private $id;
    private $id_category;
    private Category $category;
    private $id_brand;
    private Brand $brand;
    private $title;
    private $image;
    private $description;
    private $stock;
    private $price;
    private $offer_price;
    private array $tags;

    private static $createValues = ['id', 'id_category', 'id_brand', 'title', 'image', 'description', 'stock', 'price', 'offer_price'];

    /**
     * Crea un nuevo producto a partir de los datos proporcionados.
     * 
     * @param array $productData Datos del producto.
     * @return Product Instancia del producto creado.
     * @throws Exception Si ocurre un error al crear el producto.
     * @throws Exception Si la categoría, marca o tags no existen.
     */
    public static function createProduct($productData): self
    {
        // Product
        $newProduct = new self();

        foreach (self::$createValues as $value) {
            $newProduct->{$value} = $productData[$value];
        }

        // Categoría
        $newProduct->category = Category::getCategoryById($productData['id_category']);

        // Marca
        $newProduct->brand = Brand::getBrandById($productData['id_brand']);

        // tags
        $tagIds = !empty($productData['tags']) ? explode(",", $productData['tags']) : [];

        $tags = [];
        foreach ($tagIds as $tagId) {
            $tags[] = Tag::getTagById($tagId);
        };

        $newProduct->tags = $tags;

        return $newProduct;
    }

    /**
     * Obtiene todos los productos con filtros, ordenamiento y paginación.
     *
     * @param string $search Término de búsqueda (opcional).
     * @param string $categoryQuery ID de categoría o 'all' (opcional).
     * @param string $orderQuery Orden: price_asc, price_desc, name_asc, name_desc (opcional).
     * @param int $pageQuery Página actual (opcional, por defecto 1).
     * @param int $prodPerPage Productos por página (opcional, por defecto 9).
     * @return array Arreglo con productos, página actual, total de páginas y total de productos.
     */
    public static function getAllProducts(string $search = "", string $categoryQuery = "all", string $orderQuery = "price_asc", int $pageQuery = 1, int $prodPerPage = 9): array
    {
        // NOTA => No vuelvo a hacer paginación en mi vida.

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

        $query .= " LIMIT $limit OFFSET $offset";

        $productList = Database::execute($query, $params);

        $products = [];

        foreach ($productList as $product) {
            $products[] = self::createProduct($product);
        }

        return [
            "total_pages" => ceil($totalProducts / $prodPerPage),
            "current_page" => $pageQuery,
            "products" => $products,
            "total_products" => $totalProducts
        ];
    }

    /**
     * Obtiene todos los productos sin paginación.
     *
     * @return array Lista de objetos Product.
     */
    public static function getProductsWithoutPagination(): array
    {
        $query = "SELECT * FROM product";
        $productList = Database::execute($query, []);

        $products = [];

        foreach ($productList as $product) {
            $products[] = self::createProduct($product);
        }

        return $products;
    }

    /**
     * Obtiene un producto por su ID, incluyendo sus tags.
     *
     * @param string $id ID del producto.
     * @return self|null Instancia del producto encontrado o null si no existe.
     */
    public static function getProductById(string $id): ?self
    {
        $query = "SELECT product.*, GROUP_CONCAT(tag.id) as tags
              FROM product
              LEFT JOIN product_tag ON product.id = product_tag.product_id
              LEFT JOIN tag ON product_tag.tag_id = tag.id
              WHERE product.id = ?
              GROUP BY product.id";
        $params = [(int)$id];

        $results = Database::execute($query, $params);

        if (!is_array($results) || empty($results)) {
            return null;
        }

        $product = $results[0];

        return self::createProduct($product);
    }

    /**
     * Obtiene productos por ID de categoría.
     *
     * @param int $id_category ID de la categoría.
     * @return array Lista de objetos Product.
     */
    public static function getProductsByCategory(int $id_category): array
    {
        $query = "SELECT * FROM product WHERE id_category = :id_category";
        $params = ['id_category' => $id_category];
        $productList = Database::execute($query, $params);

        $products = [];

        foreach ($productList as $product) {
            $products[] = self::createProduct($product);
        }

        return $products;
    }

    /**
     * Inserta un nuevo producto en la base de datos.
     *
     * @param int $id_category ID de la categoría.
     * @param int $id_brand ID de la marca.
     * @param string $title Título del producto.
     * @param string $image Nombre o ruta de la imagen.
     * @param string $description Descripción del producto.
     * @param int $stock Cantidad en stock.
     * @param float $price Precio del producto.
     * @param float|null $offer_price Precio de oferta (opcional).
     * @param array $tags Lista de IDs de tags.
     * @return void
     * @throws Exception Si la categoría, marca o tags no existen.
     */
    public static function insertProduct($id_category, $id_brand, $title, $image, $description, $stock, $price, $offer_price, $tags): void
    {
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para crear un producto.");

        // Categoría
        $categoryQuery = 'SELECT id FROM category WHERE id = :id';
        $categoryParams = ['id' => $id_category];

        $category = Database::execute($categoryQuery, $categoryParams);

        if (empty($category)) {
            throw new Exception("La categoría con ID $id_category no existe.");
        }

        // Marca
        $brandQuery = 'SELECT id FROM brand WHERE id = :id';
        $brandParams = ['id' => $id_brand];

        $brand = Database::execute($brandQuery, $brandParams);

        if (empty($brand)) {
            throw new Exception("La marca con ID $id_brand no existe.");
        }

        // Producto
        $query = 'INSERT INTO product (id_category, id_brand, title, image, description, stock, price, offer_price) 
                  VALUES (:id_category, :id_brand, :title, :image, :description, :stock, :price, :offer_price)';
        $params = [
            'id_category' => $id_category,
            'id_brand' => $id_brand,
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'stock' => $stock,
            'price' => $price,
            'offer_price' => $offer_price
        ];

        Database::execute($query, $params, self::class);

        $productIdQuery = 'SELECT LAST_INSERT_ID() AS id';
        $productIdResult = Database::execute($productIdQuery);
        $productId = $productIdResult[0]['id'];

        if (!empty($tags)) {
            $tagQuery = 'SELECT id FROM tag WHERE id = :id';
            $validTags = [];
            foreach ($tags as $tagId) {
                $tagResult = Database::execute($tagQuery, ['id' => $tagId]);
                if (!empty($tagResult)) {
                    $validTags[] = $tagResult[0]['id'];
                }
            }

            $badTags = array_diff($tags, $validTags);
            if (!empty($badTags)) {
                throw new Exception("Los tags con IDs " . implode(', ', $badTags) . " no existen.");
            }

            $tagInsertQuery = 'INSERT INTO product_tag (product_id, tag_id) VALUES (:product_id, :tag_id)';
            foreach ($validTags as $tagId) {
                Database::execute($tagInsertQuery, [
                    'product_id' => $productId,
                    'tag_id' => $tagId
                ]);
            }
        }
    }

    /**
     * Actualiza un producto existente por su ID.
     *
     * @param string $id ID del producto.
     * @param int $id_category ID de la categoría.
     * @param int $id_brand ID de la marca.
     * @param string $title Título del producto.
     * @param string $image Nombre o ruta de la imagen.
     * @param string $description Descripción del producto.
     * @param int $stock Cantidad en stock.
     * @param float $price Precio del producto.
     * @param float|null $offer_price Precio de oferta (opcional).
     * @param array $tags Lista de IDs de tags.
     * @return bool Verdadero si la actualización fue exitosa.
     * @throws Exception Si la categoría, marca o tags no existen.
     */
    public static function updateProductById(string $id, $id_category, $id_brand, $title, $image, $description, $stock, $price, $offer_price, $tags): bool
    {
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para modificar un producto.");

        $catQuery = 'SELECT id FROM category WHERE id = :id';
        $catParams = ['id' => $id_category];
        $category = Database::execute($catQuery, $catParams);

        if (empty($category)) {
            throw new Exception("La categoría con ID $id_category no existe.");
        }

        $brandQuery = 'SELECT id FROM brand WHERE id = :id';
        $brandParams = ['id' => $id_brand];
        $brand = Database::execute($brandQuery, $brandParams);
        if (empty($brand)) {
            throw new Exception("La marca con ID $id_brand no está.");
        }

        $query = 'UPDATE product SET 
              id_category = :id_category, 
              id_brand = :id_brand, 
              title = :title, 
              image = :image, 
              description = :description, 
              stock = :stock, 
              price = :price, 
              offer_price = :offer_price 
              WHERE id = :id';
        $params = [
            'id_category' => $id_category,
            'id_brand' => $id_brand,
            'title' => $title,
            'image' => $image,
            'description' => $description,
            'stock' => $stock,
            'price' => $price,
            'offer_price' => $offer_price,
            'id' => (int)$id
        ];
        Database::execute($query, $params);

        $tagDeleteQuery = 'DELETE FROM product_tag WHERE product_id = :id';
        $tagDeleteParams = ['id' => (int)$id];
        Database::execute($tagDeleteQuery, $tagDeleteParams);

        if (!empty($tags)) {
            $tagQuery = 'SELECT id FROM tag WHERE id = :id';
            $validTags = [];
            foreach ($tags as $tagId) {
                $tagResult = Database::execute($tagQuery, ['id' => $tagId]);
                if (!empty($tagResult)) {
                    $validTags[] = $tagResult[0]['id'];
                }
            }

            $badTags = array_diff($tags, $validTags);
            if (!empty($badTags)) {
                throw new Exception("Los tags con IDs " . implode(', ', $badTags) . " no existen.");
            }

            $tagInsertQuery = 'INSERT INTO product_tag (product_id, tag_id) VALUES (:product_id, :tag_id)';
            foreach ($validTags as $tagId) {
                Database::execute($tagInsertQuery, [
                    'product_id' => (int)$id,
                    'tag_id' => $tagId
                ]);
            }
        }

        return true;
    }

    /**
     * Elimina un producto y sus tags asociados.
     *
     * @return void
     * @todo Configurar eliminación en cascada en la base de datos para los tags.
     */
    public function deleteProduct(): void
    {
        // TODO => cambiar a metodo estatico
        $isAdmin = User::isAdmin();

        if (!$isAdmin) throw new Exception("Necesitas ser admin para eliminar un producto.");

        //??? supongo que se podría cambiar en la db que se elimine en cascada cada tag

        $tagQuery = 'DELETE FROM product_tag WHERE product_id = :id';
        $tagParams = ['id' => $this->id];
        Database::execute($tagQuery, $tagParams);

        $query = 'DELETE FROM product WHERE id = :id';
        $params = ['id' => $this->id];
        Database::execute($query, $params);
    }

    /**
     * Calcula el precio del producto en cuotas.
     *
     * @param int $quote Número de cuotas (por defecto 12).
     * @return int Precio total en cuotas, redondeado hacia arriba.
     */
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
     * Get the value of tags
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Set the value of tags
     *
     * @return  self
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     *
     * @return  self
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }
}
