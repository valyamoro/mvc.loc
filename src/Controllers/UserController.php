<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Exceptions\ViewException;

/**
 * Class UserController
 *
 * @package App\Controllers
 */
class UserController extends Controller
{
    public function actionIndex(): string
    {
        $this->view->setMeta('Пользователи', 'Описание', 'ключи');
        return $this->view->render('user.index');
    }

    public function actionCreate(): string
    {
        $this->view->setMeta('Добавить Пользователи', 'Описание', 'ключи');
        return $this->view->render('user.create');
    }

}
