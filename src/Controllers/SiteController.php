<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class SiteController
 *
 * @package App\Controllers
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        $this->setMeta('Главная страница', 'Описание', 'ключи');
        $this->set([
            'title' => $this->meta['meta_title'],
            'data' => 'Ivan Morozov',
        ]);
    }

    public function actionView()
    {
        $this->setMeta('Контакты', 'Описание', 'ключи');
        $this->set([
            'title' => $this->meta['meta_title'],
            'data' => 'Ivan Morozov',
        ]);
    }

}