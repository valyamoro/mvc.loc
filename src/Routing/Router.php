<?php
declare(strict_types=1);

namespace App\Routing;

use App\Exceptions\ExceptionAction;
use App\Exceptions\ExceptionController;
use App\Exceptions\ExceptionPage;
use App\Http\Request;

/**
 * Class Router
 *
 * @package App\Routing
 */
final class Router
{
    private array $route = [];
    private array $routes = [];

    public function __construct(
        private Request $request
    ) {
    }

    public function getRoute(): array
    {
        return $this->route;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function add(string $exp, array $route = []): void
    {
        $this->routes[$exp] = $route;
    }

    public function dispatch(): void
    {
        $queryString = $this->clearQueryString($this->request->getQueryString());
        if ($this->matchRoute($queryString)) {
            $controller = 'App\\Controllers\\' . $this->route['prefix'] . $this->route['controller'] . 'Controller';
            if (\class_exists($controller)) {
                $classObj = new $controller($this->route);
                $method = 'action' . $this->upperString($this->route['action']);
                if (\method_exists($classObj, $method)) {
                    $classObj->$method();
                    $classObj->getView();
                } else {
                    throw new ExceptionAction("Метод: ({$controller}::{$method}) на найден.", 404);
                }
            } else {
                throw new ExceptionController("Контроллер: ({$controller}) на найден.", 404);
            }
        } else {
            throw new ExceptionPage("Страница: ({$this->request->getQueryString()}) не найден.");
        }
    }

    private function clearQueryString(string $uri): string
    {
        if ($uri) {
            $params = \explode('&', $uri, 2);
            if (!str_contains($params[0], '=')) {
                return \trim($params[0], '/');
            }
        }

        return '';
    }

    private function matchRoute(string $uri): bool
    {
        foreach ($this->routes as $pattern => $route) {
            if (\preg_match("#{$pattern}#", $uri, $matches)) {
                foreach ($matches as $key => $value) {
                    if (\is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                $route['action'] ??= 'index';
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }

                $route['controller'] = $this->upperString($route['controller']);
                $this->route = $route;
                return true;
            }
        }
        return false;
    }

    public function upperString(string $name): string
    {
        return \str_replace(' ', '', \ucwords(\str_replace('-', ' ', $name)));
    }

}
