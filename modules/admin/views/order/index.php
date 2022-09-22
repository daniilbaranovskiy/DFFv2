<?php

use app\modules\admin\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Замовлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return !$data->status ? '<span class="text-success">Активний</span>' : '<span class="text-danger">Одержаний</span>';
                },
                'format' => 'html',
            ],
            //'status',
            //'name',
            //'email:email',
            //'phone',
            //'address',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
