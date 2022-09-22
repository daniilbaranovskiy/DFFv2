<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <div class="row">
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($users, 'username') ?>
            <?= $form->field($users, 'password')->passwordInput() ?>
            <?= $form->field($users, 'firstname') ?>
            <?= $form->field($users, 'lastname') ?>
            <?= $form->field($users, 'number') ?>
            <?= $form->field($users, 'city') ?>
            <?= Html::submitButton('Зареєструватись', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
<br>
