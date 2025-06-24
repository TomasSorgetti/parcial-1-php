<?php

class Page
{
    private $id;
    private $path;
    private $title;
    // private $description;
    private $active;
    private $restricted;

    /**
     * Obtiene una instancia de la clase Page si existe el path, sino devuelve la página 404
     * @param string $pagePath 
     * @return Page
     */
    public static function getPage(string $pagePath): Page
    {
        $query = 'SELECT * FROM page WHERE path = :path';
        $params = ['path' => $pagePath];

        // execute devuelve un array de 1 solo elemento por el tipo de fetch
        $pages = Database::execute($query, $params, self::class);

        if (!empty($pages)) {
            $page = $pages[0];

            if (!$page->getActive()) {
                return self::createErrorPage(503);
            }

            if ($page->getRestricted()) {
                $hasPermissions = Auth::verify($page->getRestricted());

                if (!$hasPermissions) {
                    return self::createErrorPage(403);
                } else {
                    return $page;
                }
            }

            return $page;
        }

        return self::createErrorPage(404);
    }

    /**
     * Crea una instancia de la clase Page de error
     * @param int $type 
     * @return Page
     */
    private static function createErrorPage(int $type = 404): Page
    {
        $page = new self();
        switch ($type) {
            case 403:
                $page->title = 'No tenés permisos';
                break;
            case 404:
                $page->title = 'Página no encontrada';
                break;
            case 503:
                $page->title = 'Servicio no disponible';
                break;
            default:
                $page->title = 'Error desconocido';
                break;
        }
        $page->id = $type;
        $page->path = (string)$type;
        $page->active = false;
        $page->restricted = false;
        return $page;
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
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
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
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get the value of restricted
     */
    public function getRestricted()
    {
        return $this->restricted;
    }

    /**
     * Set the value of restricted
     * @return self
     */
    public function setRestricted($restricted)
    {
        $this->restricted = $restricted;
        return $this;
    }
}
