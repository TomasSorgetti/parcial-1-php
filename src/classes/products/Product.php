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