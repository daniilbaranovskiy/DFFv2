<?php if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <td>Фото</td>
                <td>Назва</td>
                <td>Кількість</td>
                <td>Ціна</td>
                <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($session['cart'] as $id => $item): ?>
                <tr>
                    <td><?= yii\helpers\Html::img($item['img'], ['alt' => $item['name'], 'height' => 50]) ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item"
                              aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Всього:</td>
                <td><?= $session['cart.qty'] ?></td>
            </tr>
            <tr>
                <td colspan="4">Сума:</td>
                <td><?= $session['cart.sum'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h2>Кошик порожій</h2>
<?php endif; ?>
