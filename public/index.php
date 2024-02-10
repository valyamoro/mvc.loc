<?php
declare(strict_types=1);
error_reporting(-1);

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $request = new \App\Http\Request();
    $router = new \App\Routing\Router($request);

    $router->add('on-nas', ['controller' => 'Site', 'action' => 'view']);
    $router->add('contact', ['controller' => 'Site', 'action' => 'view']);
    $router->add('^$', ['controller' => 'Site', 'action' => 'index']);
    $router->add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

    $uri = \trim($_SERVER['QUERY_STRING'], '/');
    echo $router->dispatch();
} catch (\Exception $e) {
    echo $e->getMessage();
}
