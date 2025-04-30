<?php

class Page {
    private $title;
    private $description;
    private $path;

    private function getAllPages(): array {
        return json_decode(file_get_contents('lib/data/pages.json'), true) ?? [];
    }

    private function isValidPath(string $pagePath): bool {
        $pages = $this->getAllPages();

        foreach ($pages as $page) {
            if ($page['path'] === $pagePath) {
                return true;
            }
        }
        return false;
    }

    public static function getPage(string $pagePath):Page {
        $page = new Page();

        if ($page->isValidPath($pagePath)) {
            $pages = $page->getAllPages();
            foreach ($pages as $p) {
                if ($p['path'] === $pagePath) {
                    $page->title = $p['title'];
                    $page->description = $p['description'];
                    $page->path = $p['path'];
                }
            }
            return $page;
        }

        $page->title = '404';
        $page->description = 'Error 404';
        $page->path = '404';
        return $page;
    }

}