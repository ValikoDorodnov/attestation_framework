<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Base\WebController;

final class WebArticleController extends WebController
{
    public function index()
    {
        echo $this->render('Site/index');
    }
}
