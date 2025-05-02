<?php

class Page {
    private $path;
    private $title;
    private $description;
    private $active;
    private $restricted;

    /**
     * Obtiene la lista de páginas existentes
     * @return array
     */
    private function getAllPages(): array {
        // todo => deberia validar que exista el archivo
        return json_decode(file_get_contents('lib/data/pages.json'), true) ?? [];
    }

    /**
     * Valida que la página sea válida
     * @param string $pagePath
     * @return bool
     */
    private function isValidPath(string $pagePath): bool {
        $pages = $this->getAllPages();

        foreach ($pages as $page) {
            if ($page['path'] == $pagePath) {
                return true;
            }
        }
        return false;
    }

    /**
     * Obtiene una instancia de la clase Page si existe el path, sino devuelve la pagina 404
     * @param string $pagePath 
     * @return Page
     */
    public static function getPage(string $pagePath):Page {
        $page = new self();
        
        if ($page->isValidPath($pagePath)) {
            $pages = $page->getAllPages();
            foreach ($pages as $p) {
                if ($p['path'] === $pagePath) {
                    $page->title = $p['title'];
                    $page->description = $p['description'];
                    $page->path = $p['path'];
                    $page->active = isset($p['active']) ? (bool) $p['active'] : false;
                    $page->restricted = isset($p['restricted']) ? (bool) $p['restricted'] : false;
                }
            }
            if(!$page->active) {
                return $page->createErrorPage(503);
            }
            if($page->restricted) {
                return $page->createErrorPage(403);
            }
            return $page;
        }

        return $page->createErrorPage(404);
    }

    /**
     * Crea una instancia de la clase Page de error
     * @param int $type 
     * @return Page
     */
    private function createErrorPage(int $type=404):Page {
        // TODO => deberia validar que exista el archivo de error
        $page = new self();
        switch ($type) {
            case 403:
                $page->title = 'No tienes permisos';
                break;
            case 404:
                $page->title = 'Ups! Ocurrio un error';
                break;
            case 500:
                $page->title = 'Ups! El servidor tiene problemas';
                break;
            case 503:
                $page->title = 'Ups! El servicio no esta disponible';
                break;
            default:
                $page->title = 'Ups! Ocurrio un error';
                break;
        }
        $page->path = $type;
        $page->description = 'Error' . $type;
        $page->active = 1;
        $page->restricted = 0;
        return $page;
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
     *
     * @return  self
     */ 
    public function setRestricted($restricted)
    {
        $this->restricted = $restricted;

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
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

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