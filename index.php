<?php

require_once('vendor/autoload.php');


$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/app/routes.php';

$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}

if (!$isRouteFound) {
    throw new \Exception();
}

unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];


$urlRepository = new \App\Repository\UrlRepository();
$controller = new $controllerName($urlRepository);
$controller->$actionName(...$matches);
