<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/pages/home.php';
        break;
    case '/index' :
        require __DIR__ . '/pages/index.php';
        break;
    case '/reset' :
        require __DIR__ . '/pages/reset.php';
        break;
    case '/room' :
        require __DIR__ . '/pages/room.php';
        break;
    default:
        http_response_code(404);
        echo "Page not found.";
        break;
}