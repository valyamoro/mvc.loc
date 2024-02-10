<?php
declare(strict_types=1);

namespace App\Core;

use App\Http\Request;

/**
 * Class Controller
 *
 * @package App\Core
 */
abstract class Controller
{
    protected ?string $layout = null;
    protected View $view;
    public function __construct(Request $request)
    {
        $this->view = new View($this->layout);
    }

}
