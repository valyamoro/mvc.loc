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
    private const DEFAULT_LAYOUT = 'layouts.default';
    private array $meta;

    public function __construct(
        private ?string $layout = null,
    ) {
        if (\is_null($layout)) {
            $this->layout = self::DEFAULT_LAYOUT;
        }
    }

    public function render(string $template, array $viewData = []): string
    {
        if ('' === $this->layout) {
            throw new ViewException("Шабло не может быть пустым.");
        } else {
            $layoutPath = __DIR__ . "/../../views/{$this->replaceDotsWithSlashes($this->layout)}.php";
            if (!\is_file($layoutPath)) {
                throw new ViewException("Шаблон: {$layoutPath} не найден.");
            } else {
                $content = $this->buffering($layoutPath, $this->meta);
            }
            $viewPath = __DIR__ . "/../../views/{$this->replaceDotsWithSlashes($template)}.php";
            if (!\is_file($viewPath)) {
                throw new ViewException("Вид: ({$viewPath}) не найден.");
            } else {
                $content .= $this->buffering($viewPath, $viewData);
            }
            return $content;
        }
    }

    private function buffering(string $filePath, array $data = []): string
    {
        \extract($data);
        \ob_start();
        require $filePath;
        return \ob_get_clean();
    }

    private function replaceDotsWithSlashes(string $value): string
    {
        return \str_replace('.', '/', $value);
    }

    public function setMeta(string $title = '', string $description = '', string $keywords = ''): void
    {
        $this->meta['metaTitle'] = $title;
        $this->meta['metaDescription'] = $description;
        $this->meta['metaKeywords'] = $keywords;
    }

}
