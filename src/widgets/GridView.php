<?php
namespace yiilte\widgets;

/*
use metronic\widgets\GridView
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'name',
        ['class' => 'metronic\widgets\ActionColumn'],
    ],
]); ?>
 */
class GridView extends \yii\grid\GridView
{
    public $layout = "{summary}{items}{pager}";

    public $options = [
        'style'=>'overflow: auto;',
    ];

    public function init(){
        parent::init(); // TODO: Change the autogenerated stub
    }
}
?>