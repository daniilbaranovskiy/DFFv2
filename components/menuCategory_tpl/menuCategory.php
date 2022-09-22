<li>
    <a href=" <?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>">
        <?= $category['name'] ?>
        <?php if (isset($category['children'])): ?>
            <span class="badge pull-right">
                <i class="fa fa-plus"></i>
            </span>
        <?php endif; ?>
        <?php if (isset($category['children'])): ?>
            <ul>
                <?= $this->getMenuHtml($category['children']) ?>
            </ul>
        <?php endif; ?>
    </a>
</li>