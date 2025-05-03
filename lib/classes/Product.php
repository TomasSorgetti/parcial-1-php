<?php
class Product {
    private $id;
    private $title;
    private $list_price;
    private $sale_price;
    private $description;
    private $image;
    private $category;

    /**
     * Obtiene la lista de productos existentes
     * @param string $categoryQuery
     * @param string $orderQuery
     * @param int $pageQuery
     * @return array 
     */
    public static function getAllProducts(string $search="", string $categoryQuery= "all", string $orderQuery = "price_asc", int $pageQuery= 1): array {
        $productList = json_decode(file_get_contents('lib/data/products.json'), true) ?? [];
        $prodPerPage = 9;

        //* el filter basicamente compara y si es true lo incluye en el array
        $filtredProducts = array_filter($productList, function ($product) use ($search, $categoryQuery) {
            if ($search != "") {
                $search = strtolower(trim($search));
                $title = strtolower($product["title"]);
                
                if (strpos($title, $search) === false) {
                    return false;
                }
            }
            
            //TODO => agregar filtro por categoria
            if ($categoryQuery != "all") {
                if ($product["category"] !== $categoryQuery) {
                    return false;
                }
            }

            return true;
        });

        //* usort seria el equivalente a sort de js usort(array &$array, callable $value_compare_func): bool
        // orderQuery puede ser price_asc | price_desc | name_asc | name_desc
        usort($filtredProducts, function ($a, $b) use ($orderQuery) {
            switch ($orderQuery) {
                case "price_asc":
                    if ($a["list_price"] < $b["list_price"]) {
                        return -1;
                    } elseif ($a["list_price"] > $b["list_price"]) {
                        return 1;
                    } else {
                        return 0;
                    }

                case "price_desc":
                    if ($b["list_price"] < $a["list_price"]) {
                        return -1;
                    } elseif ($b["list_price"] > $a["list_price"]) {
                        return 1;
                    } else {
                        return 0;
                    }

                case "name_asc":
                    return strcmp($a["title"], $b["title"]);

                case "name_desc":
                    return strcmp($b["title"], $a["title"]);

                default:
                    if ($a["list_price"] < $b["list_price"]) {
                        return -1;
                    } elseif ($a["list_price"] > $b["list_price"]) {
                        return 1;
                    } else {
                        return 0;
                    }
            }
        });

        $products = [];

        foreach ($filtredProducts as $product) {
            $newProduct = new self();
            $newProduct->id = $product["id"];
            $newProduct->title = $product["title"];
            $newProduct->list_price = $product["list_price"];
            $newProduct->sale_price = $product["sale_price"];
            $newProduct->description = $product["description"];
            $newProduct->image = $product["image"];
            $newProduct->category = $product["category"];

            $products[] = $newProduct;
        }

        return [
            "total_pages" => ceil(count($products) / $prodPerPage),
            "current_page" => $pageQuery,
            "products" => $products,
            "total_products" => count($products)
        ];
    }

    /**
     * Obtiene un producto por su id
     * @param string $id
     * @return Product
     */
    public static function getProductById(string $id): ?self {
        $productList = json_decode(file_get_contents('lib/data/products.json'), true) ?? [];

        foreach ($productList as $product) {
            if ($product["id"] === intval($id)) {
                $newProduct = new self();
                $newProduct->id = $product["id"];
                $newProduct->title = $product["title"];
                $newProduct->list_price = $product["list_price"];
                $newProduct->sale_price = $product["sale_price"];
                $newProduct->description = $product["description"];
                $newProduct->image = $product["image"];
                $newProduct->category = $product["category"];

                return $newProduct;
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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of list_price
     */ 
    public function getList_price()
    {
        return $this->list_price;
    }

    /**
     * Set the value of list_price
     *
     * @return  self
     */ 
    public function setList_price($list_price)
    {
        $this->list_price = $list_price;

        return $this;
    }

    /**
     * Get the value of sale_price
     */ 
    public function getSale_price()
    {
        return $this->sale_price;
    }

    /**
     * Set the value of sale_price
     *
     * @return  self
     */ 
    public function setSale_price($sale_price)
    {
        $this->sale_price = $sale_price;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

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
};