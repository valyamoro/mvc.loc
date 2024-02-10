<?php
declare(strict_types=1);

namespace App\Core;

use App\Exceptions\ViewException;

/**
 * Class View
 *
 * @package App\Core
 */
final class View
{
    private array $route;
    private string $controller;
    private string $action;
    private string $view;
    private string $layout;
    private array $meta;

    public function __construct(
        array $route,
        array $meta = [],
        string $layout = '',
        string $view = '',
    )
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->action = $route['action'];
        $this->meta = $meta;
        $this->layout = $layout;
        $this->view = $view;
        if (false === $layout) {
            $this->layout = '';
        } else {
            $this->layout = $layout ?: 'default';
        }
    }

    public function render(array $data): void
    {
        if (\is_array($data)) {
            \extract($data);
        }
        $controller = \strtolower($this->controller);
        $viewPath = __DIR__ . "/../../views/{$controller}/{$this->view}.php";
        if (\is_file($viewPath)) {
            ob_start();
            require $viewPath;
            $content = ob_get_clean();
        } else {
            throw new ViewException("Вид: ({$viewPath}) не найден.");
        }
        if (false !== $this->layout) {
            $layoutPath = __DIR__ . "/../../views/layouts/{$this->layout}.php";
            if (\is_file($layoutPath)) {
                require $layoutPath;
            } else {
                throw new ViewException("Шаблон: {$viewPath} не найден.");
            }
        }
    }

    public function getMeta(): string
    {
        $meta = '<title>' . $this->meta['meta_title'] . '</title>';
        $meta .= '<meta mane="keywords" content="' . $this->meta['meta_keywords'] . '">';
        $meta .= '<meta name="description" content="' . $this->meta['meta_description'] . '">';

        return $meta;
    }

}
