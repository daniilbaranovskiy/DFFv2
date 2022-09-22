<?php

namespace app\controllers;

use app\models\Category;
use app\models\Menu;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex()
    {

        $query = Menu::find()->where(['hit' => '1']);
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE]);
        $hits = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('DFF');
        return $this->render('index', compact('hits', 'pages'));
    }

    public function actionView($id)
    {
        $category = Category::findOne($id);
        if (empty($category))
            throw new \yii\web\HttpException(404, 'Такої категорії не існує');
        $query = Menu::find()->where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE]);
        $dish = $query->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta('DFF ' . $category->name, $category->keywords, $category->description);
        return $this->render('view', compact('dish', 'pages', 'category'));
    }

    public function actionSearch()
    {

        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('DFF | Пошук: ' . $q);
        if (!$q)
            return $this->render('search');
        $query = Menu::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => FALSE,
            'pageSizeParam' => FALSE]);
        $dish = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('dish', 'pages', 'q'));
    }

}