<?php

namespace app\modules\user\controllers;

use yii\web\Controller;

class DefaultController extends AppUserController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
