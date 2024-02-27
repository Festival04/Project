<?php
// 02.2024 Artur Z (HUSKI3@GitHub)

class SitemapController {

    public function __construct() 
    {
        require_once("app/models/page.php");
        require_once("app/repositories/sitemap.php");
        require_once("app/controllers/page.php");
        $this->repo = new SiteMapRepo();
        $this->pageController = new PagesController();
    }

    public function get($route) {
        $routeval = $repo->getOne($route);
        if ($routeval == null) {
            return null;
        } 
        $id = $routeval[2];
        return $pageController->getpage($id);
    }

    public function createRoute($route, $id, $userid) {
        $id = $repo->newOne($route, $id);
        if ($id == null) {
            return null;
        } 
        $_page = $pageController->getpage($id);
        return $_page;
    }

}
?>