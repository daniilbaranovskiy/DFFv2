<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="container">
    <h2>Акаунт</h2>
    <h3>Привіт, <?= $user['firstname'] ?></h3><br>
    <h4>Інформація про ваш акаунт:</h4>
    <?php if ($user['role'] != 'admin'): ?>
        <h4>Статус: Користувач </h4>
    <?php else: ?>
        <h4>Статус: Адмін </h4>
    <?php endif; ?>
    <h4>Логін: <?= $user['username'] ?></h4>
    <h4>Ім'я: <?= $user['firstname'] ?></h4>
    <h4>Прізвище: <?= $user['lastname'] ?></h4>
    <h4>Номер телефону: <?= $user['number'] ?></h4>
    <h4>Місто: <?= $user['city'] ?></h4>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['user/users']) ?>">Переглянути інформацію про акаунт</a><br>
    <br>
    <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['user/order']) ?>">Переглянути інформацію про замовлення</a> <br>
    <br>
    <?php if ($user['role'] == 'admin'): ?>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['admin/order']) ?>">Переглянути інформацію про всі замовлення</a> <br>
        <br>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['admin/category']) ?>">Переглянути категорії</a> <br>
        <br>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['admin/menu']) ?>">Переглянути страви у меню</a> <br>
        <br>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['admin/users']) ?>">Переглянути список
            користувачів</a> <br>
        <br>
        <a class="btn btn-primary" href="<?= yii\helpers\Url::to(['/backup']) ?>">Переглянути бекапи</a> <br>
        <br>
    <?php endif; ?>
</div>
<br>
