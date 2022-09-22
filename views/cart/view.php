<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="container">
    <?php if (Yii::$app->session->hasFlash('success')) :?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo Yii::$app->session->getFlash('success'); ?></strong>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')) :?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo Yii::$app->session->getFlash('error'); ?></strong>
        </div>
    <?php endif; ?>
    <?php if(!empty($session['cart'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <td>Фото</td>
                    <td>Назва</td>
                    <td>Кількість</td>
                    <td>Ціна</td>
                    <td>Сума</td>
                    <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach($session['cart'] as $id => $item): ?>
                    <tr>
                        <td><?= yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]) ?></td>
                        <td><a href="<?= Url::to(['dish/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><?= $item['qty'] * $item['price']?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5">Всого: </td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="5">Сума: </td>
                    <td><?= $session['cart.sum'] ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <hr/>
        <div class="container">
            <div class="row">
                <div class="col-xs-4" >
                </div>
                <div class="col-xs-4">
                    <?php $form = ActiveForm::begin() ?>
                    <?= $form->field($order, 'name')->textInput(['value' => $user['firstname']])?>
                    <?= $form->field($order, 'email')?>
                    <?= $form->field($order, 'phone')->textInput(['value' => $user['number']])?>
                    <?= $form->field($order, 'address')?>
                    <?= Html::submitButton('Замовити', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
        <br>
    <?php else: ?>
        <h2>Кошик пустий</h2>
    <?php endif; ?>
</div>


