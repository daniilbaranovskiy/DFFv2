<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1>Перегляд замовлення під номером: <?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            //'status',
            [
                'attribute' => 'status',
                'value' => function($data) {
                    return !$data->status ? '<span class="text-success">Активний</span>' : '<span class="text-danger">Одержаний</span>';
                },
                'format' => 'html',
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>
    <?php $items = $model->orderItems; ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>Назва</td>
                <td>Кількість</td>
                <td>Ціна</td>
                <td>Сума</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><a href="<?= Url::to(['/dish/view', 'id' => $item->dish_id]) ?>"><?= $item['name'] ?></a></td>
                    <td><?= $item['qty_item'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['sum_item'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
