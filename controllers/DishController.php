<?php

namespace app\controllers;
use app\models\Category;
use app\models\Menu;
use Yii;

class DishController extends AppController
{
    public function actionView($id){
        $dish = Menu::findOne($id);
        if(empty($dish))
            throw new \yii\web\HttpException(404, 'Такого елемета меню не існує');
        $hits = Menu::find()->where(['hit' => '1'])->all();
        $this->setMeta('DFF | ' . $dish->name, $dish->keywords, $dish->description);
        return $this->render('view', compact('dish', 'hits'));
    }
}