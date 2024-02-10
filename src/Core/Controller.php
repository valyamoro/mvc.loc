<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Class Controller
 *
 * @package App\Core
 */
abstract class Controller
{
    private array $route;
    private string $controller;
    private string $view;
    private string $prefix;
    private array $data = [];
    protected array $meta = [
        'meta_title' => '',
        'meta_keywords' => '',
        'meta_description' => '',
    ];
    protected string $layout = '';

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView(): void
    {
        $view = new View($this->route, $this->meta, $this->layout, $this->view);
        $view->render($this->data);
    }

    protected function set(array $data): void
    {
        $this->data = $data;
    }

    protected function setMeta(string $title = '', string $description = '', string $keywords = ''): void
    {
        $this->meta['meta_title'] = $title;
        $this->meta['meta_description'] = $description;
        $this->meta['meta_keywords'] = $keywords;
    }

}
