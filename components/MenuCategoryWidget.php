<?php

namespace app\components;

use Yii;
use yii\base\Widget;
use app\models\Category;

class MenuCategoryWidget extends Widget
{
    public $tpl;
    public $data; //властивість дата (В ній зберігаються всі записи категорій з бд)
    public $model;
    public $tree; //властивість Tree (В ній зберігається результат роботи функції дата и записується масив в вигляді дерева)
    public $menuCategoryHtml;


    public function init()
    {
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'menuCategory';
        }
        $this->tpl .= '.php';
    }

    public function run()
    {
        if($this->tpl == 'menuCategory.php') {
            $menu = Yii::$app->cache->get('menuCategory');
            if($menu) return $menu;
        }
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuCategoryHtml = $this->getMenuHtml($this->tree);
        if($this->tpl == 'menuCategory.php') {
            Yii::$app->cache->set('menuCategory', $this->menuCategoryHtml, 60);
        }
        return $this->menuCategoryHtml;
    }

    protected function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab)
    {
        ob_start();
        include __DIR__ . '/menuCategory_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}