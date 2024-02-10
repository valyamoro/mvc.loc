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
    public function actionIndex(): string
    {
        $this->view->setMeta('Главная', 'Описание', 'Ключи');
        return $this->view->render('site.index');
    }

    public function actionView(): string
    {
        $this->view->setMeta('Контакты', 'Описание', 'ключи');
        return $this->view->render('site.view', ['title' => 'Контакты']);
    }

}