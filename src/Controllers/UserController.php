<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class UserController
 *
 * @package App\Controllers
 */
class UserController extends Controller
{
    public function actionIndex()
    {
        $this->setMeta('Пользователи', 'Описание', 'ключи');
        $this->set([
            'title' => $this->meta['meta_title'],
            'data' => 'Ivan Morozov',
        ]);
    }

    public function actionCreate()
    {
        $this->setMeta('Добавить Пользователи', 'Описание', 'ключи');
        $this->set([
            'title' => $this->meta['meta_title'],
            'data' => 'Ivan Morozov',
        ]);
    }

}
