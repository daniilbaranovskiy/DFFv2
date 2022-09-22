<?php

use app\modules\admin\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Додати страву', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name ? $data->category->name : false;
                },
            ],
            'name',
            //'content:ntext',
            'price',
            [
                'attribute' => 'hit',
                'value' => function($data) {
                    return !$data->hit ? '<span class="text-danger">Ні</span>' : '<span class="text-success">Так</span>';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'new',
                'value' => function($data) {
                    return !$data->new ? '<span class="text-danger">Ні</span>' : '<span class="text-success">Так</span>';
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'sale',
                'value' => function($data) {
                    return !$data->sale ? '<span class="text-danger">Ні</span>' : '<span class="text-success">Так</span>';
                },
                'format' => 'raw'
            ],
            //'keywords',
            //'description',
            //'img',
            //'hit',
            //'new',
            //'sale',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Menu $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
