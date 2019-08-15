<?php
namespace vuelte\widgets;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class DetailView extends \yii\widgets\DetailView{
    /**
     * Renders the detail view.
     * This is the main entry of the whole detail view rendering.
     */
    public function run()
    {
        $rows = [];
        $i = 0;
        foreach ($this->attributes as $attribute) {
            $rows[] = $this->renderAttribute($attribute, $i++);
        }

        $options = $this->options;
        $tag = ArrayHelper::remove($options, 'tag', 'table');
        $tbody = Html::tag("tbody", implode("\n", $rows));
        echo Html::tag($tag, $tbody, $options);
    }
}
?>