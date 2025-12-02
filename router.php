<?php

require_once(__DIR__ . '/auth.php');

startSession();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Remove leading slash and split by /
$path = trim($requestUri, '/');
$segments = $path ? explode('/', $path) : [];

// Route handling
if (empty($segments) || $segments[0] === '') {
    // Home page - show projects
    require_once(__DIR__ . '/controllers/ProjectController.php');
    $controller = new ProjectController();
    $controller->index();
} elseif ($segments[0] === 'admin') {
    require_once(__DIR__ . '/controllers/AdminController.php');
    $controller = new AdminController();
    
    if (isset($segments[1]) && $segments[1] === 'login') {
        $controller->login();
    } elseif (isset($segments[1]) && $segments[1] === 'logout') {
        $controller->logout();
    } else {
        $controller->index();
    }
} else {
    // 404 - show projects as fallback
    require_once(__DIR__ . '/controllers/ProjectController.php');
    $controller = new ProjectController();
    $controller->index();
}

