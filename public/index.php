<?php
declare(strict_types=1);
error_reporting(-1);

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $router = new \App\Routing\Router();

    $router->add('on-nas', ['controller' => 'Site', 'action' => 'view']);
    $router->add('contact', ['controller' => 'Site', 'action' => 'view']);
    $router->add('^$', ['controller' => 'Site', 'action' => 'index']);
    $router->add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

    $uri = \trim($_SERVER['QUERY_STRING'], '/');
    $router->dispatch($uri);
} catch (\Exception $e) {
    echo $e->getMessage();
}
