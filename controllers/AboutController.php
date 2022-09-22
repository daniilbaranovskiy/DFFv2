<?php

namespace app\controllers;

class AboutController extends AppController
{
    public function actionIndex() {
        $this->setMeta('DFF | Про нас ');
        return $this->render('index');
    }

}