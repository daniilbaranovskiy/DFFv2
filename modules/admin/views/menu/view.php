<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені що хочете видалити цю страву?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php $img = $model->getImage(); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name ? $data->category->name : false;
                },
            ],
            'name',
            'content:html',
            'price',
            'keywords',
            'description',
            [
                'attribute' => 'image',
                'value' => "<img src='{$img->getUrl()}'>",
                'format' => 'html'
            ],
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
            //'hit',
            //'new',
            //'sale',
        ],
    ]) ?>

</div>
