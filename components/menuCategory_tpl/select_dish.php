<option
    value="<?= $category['id'] ?>"
    <?php if($category['id'] == $this->model->category_id) echo ' selected' ?>>
    <?= $tab . $category['name'] ?>
</option>
<?php if( isset($category['children']) ): ?>
    <ul>
        <?= $this->getMenuHtml($category['children'], $tab . '-') ?>
    </ul>
<?php endif ?>


