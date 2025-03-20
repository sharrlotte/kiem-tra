<?php
// Autoload classes
spl_autoload_register(function ($class) {
    $paths = [
        'app/controllers/',
        'app/models/'
    ];

    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
session_start();
// Get controller and action from URL
$controller = $_GET['controller'] ?? 'default';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Convert controller name to proper class name
$controllerName = ucfirst($controller) . 'Controller';

// Create controller instance and call action
if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $action)) {
        if ($id !== null) {
            $controller->$action($id);
        } else {
            $controller->$action();
        }
    } else {
        die('Action not found');
    }
} else {
    die('Controller not found');
}
