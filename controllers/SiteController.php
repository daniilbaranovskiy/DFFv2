<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Register;
use app\models\User;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->setMeta('DFF | Вхід');
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        $this->setMeta('DFF | Реєстрація');
        $users = new Register();
        if ($users->load(\Yii::$app->request->post()) && $users->validate()) {
            $user = new User();
            $user->username = $users->username;
            $user->password = \Yii::$app->security->generatePasswordHash($users->password);
            $user->firstname = $users->firstname;
            $user->lastname = $users->lastname;
            $user->number = $users->number;
            $user->city = $users->city;
            if ($user->save())
            {
                \Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('register', compact('users'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
