<?php

namespace app\controllers;

use app\models\User;
use Yii;

class AccountController extends AppController
{
    public function actionIndex() {
        $user = User::find()->where(['id' => Yii::$app->user->getId()])->one();
        $this->setMeta('DFF | Акаунт ');
        if (Yii::$app->user->isGuest) {
            $message = 'Доступ до даної сторінки можуть мати тільки авторизовані користувачи';
            return $this->render('error', compact('message'));
        } else
        return $this->render('index',compact('user'));
    }

}