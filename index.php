<?php

$loader = require_once __DIR__.'/vendor/autoload.php';
$loader->addPsr4('Routes\\', __DIR__ . '/Routes');
$loader->addPsr4('Classes\\', __DIR__ . '/Classes');
$loader->addPsr4('Controllers\\', __DIR__ . '/Controllers');
$loader->addPsr4('Models\\', __DIR__ . '/Models');

use Routes\Router;
use Controllers\HomeController;
use Controllers\ContactController;
use Controllers\AdminController;
use Controllers\CartController;
use Controllers\ProductsController;
use Classes\HandleAuthorization;
use Controllers\AuthController;

session_start();

$router = new Router();

$router->get('/', function ($request) {
    $controller = new HomeController();
    $controller->showHomepage($request);
    return;
});

$router->post('/producten', function($request) {
    $controller = new HomeController();
    $controller->filter($request);
});

$router->get('/search', function ($request) {
    $controller = new HomeController();
    $controller->search($request);
    return;
});

$router->get('/contact', function ($request) {
    $controller = new ContactController();
    $controller->show($request);
    return;
});

$router->post('/contact', function ($request) {
    $controller = new ContactController();
    $controller->handle($request);
    return;
});

$router->get('/admin/dashboard', function($request) {
    $controller = new AdminController();
    $controller->showDashboard($request);
    return;
});

$router->get('/producten', function ($request) {
    $controller = new HomeController();
    $controller->showProducts($request);
    return;
});

$router->get('/winkelmand', function($request) {
    $controller = new CartController();
    $controller->show($request);
    return;
});

$router->get('/afrekenen', function($request) {
    $controller = new CartController();
    $controller->checkout($request);
    return;
});

$router->post('/cart', function($request) {
    $controller = new CartController();
    $controller->handle($request);
    return;
});

$router->post('/admin/product/verwijderen', function($request) {
    $controller = new ProductsController();
    $controller->delete($request);
    return;
});

$router->get('/admin/product/toevoegen', function ($request) {
    $controller = new ProductsController();
    $controller->showNewProduct($request);
    return;
});

$router->post('/admin/product/toevoegen', function ($request) {
    $controller = new ProductsController();
    $controller->createNewProduct($request);
    return;
});

$router->get('/admin/producten', function ($request) {
    $controller = new ProductsController();
    $controller->showAll($request);
    return;
});

$router->get('/admin/product/aanpassen', function ($request) {
    $controller = new ProductsController();
    $controller->viewProduct($request);
    return;
});

$router->post('/admin/product/aanpassen', function ($request) {
    $controller = new ProductsController();
    $controller->updateProduct($request);
    return;
});

$router->get('/registreren', function ($request) {
    if ($request->isLoggedIn()) {
        $request->redirect('/');
        return;
    }
    $controller = new AuthController();
    $controller->showRegistrationPage($request);
    return;
});

$router->post('/registreren', function ($request) {
    $controller = new HandleAuthorization();
    $controller->handleRegistration($request);
    return;
});

$router->get('/inloggen', function ($request) {
    if ($request->isLoggedIn()) {
        $request->redirect('/');
        return;
    }
    $controller = new AuthController();
    $controller->showLoginPage($request);
    return;
});

$router->post('/inloggen', function ($request) {
    $request->login($request->input('username'), $request->input('password'));
    return;
});

$router->post('/afmelden', function ($request) {
    $request->logout();
    $request->redirect('/');
    return;
});