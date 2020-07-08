<?php

namespace backend\modules\admin\controllers;

use backend\components\Controller;

class DashboardController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }
}
