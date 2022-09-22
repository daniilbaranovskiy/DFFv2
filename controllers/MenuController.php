<?php

namespace app\controllers;

use app\models\Menu;
use yii\data\Pagination;

class MenuController extends AppController
{
    public function actionIndex() {

        $query = Menu::find();
        $this->setMeta('DFF | Меню ');
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE]);
        $dishs = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('dishs','pages'));
    }

}