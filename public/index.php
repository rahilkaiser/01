<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Blog\Core\Container;
use Blog\Core\Router;
use Blog\Controllers\PostController;
use Blog\Repositories\PostRepository;
use Blog\Models\Post;
use Blog\Services\PostService;

try {
    $container = new Container();

    // Registrieren der Services
    $container->register('post.model', function() {
        return new Post();
    });

    $container->register('post.repository', function($c) {
        return new PostRepository($c->resolve('post.model'));
    });

    $container->register('post.service', function($c) {
        return new PostService($c->resolve('post.repository'));
    });

    $container->register('post.controller', function($c) {
        return new PostController($c->resolve('post.service'));
    });

    $container->register('router', function() {
        return new Router();
    });

    // Router konfigurieren
    $router = $container->resolve('router');
    $postController = $container->resolve('post.controller');

    $router->get('/', [$postController, 'index']);
    $router->get('/post/create', [$postController, 'create']);
    $router->post('/post/store', [$postController, 'store']);
    $router->get('/post/edit', [$postController, 'edit']);
    $router->post('/post/update', [$postController, 'update']);
    $router->post('/post/delete', [$postController, 'delete']);

    // Request verarbeiten
    ob_start();
    $router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    $content = ob_get_clean();

    echo $content;

} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo "Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.";
}
