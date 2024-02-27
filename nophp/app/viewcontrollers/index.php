<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
echo <h1> "Hello from NoPHP " . nophp_version() . "!" </h1>;

namespace App;


require_once('app/common.php');
require_once('app/controllers/page.php');
require_once('app/controllers/sitemap.php');
session_start();

// Let's try to create an index and shit

// Create a user Controller instance
// $pageController = new PagesController();

// $page = $pageController->createpage(1);

// if ($page == null) {
//     echo "Failed to create page";
// } 

// Bind it to the route
$sitemapController = new SitemapController();

// $route = $routeController->get("/");

// if ($route == null) {
//     $routeController->createRoute("/", 1, 0);
// }

// echo $route;

$route = $sitemapController->get("/");
echo 
<div>
    <h1> $route->title</h1>
    . <p> $route->content </p>
</div>;


?>