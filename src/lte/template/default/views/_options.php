<?php

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$urlParams = $generator->generateUrlParams();
$primaryKey = $model::primaryKey()[0] ?: "id";

echo "<?php\n";
?>

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$list = [
    "index" => true,
    "create" => true,
    "update" => !empty($model) && isset(<?="\$model->$primaryKey"?>),
    "delete" => !empty($model) && isset(<?="\$model->$primaryKey"?>),
];
$list[$this->context->action->id] = false;
?>
<component-template>
    <div>
        <?= "<?= " ?>$list["index"] ? Html::tag("lte-btn","<i class='glyphicon glyphicon-list'></i> 列表",[
            "href"=>Url::to(["index"]),
            "a"=>true,
            "block"=>true,
        ]):null?>
        <?= "<?= " ?>$list["create"] ? Html::tag("lte-btn","<i class='glyphicon glyphicon-plus'></i> 添加",[
            "href"=>Url::to(["create"]),
            "a"=>true,
            "block"=>true,
            "type"=>"info"
        ]):null?>
        <?= "<?= " ?>$list["update"] ? Html::tag("lte-btn","<i class='glyphicon glyphicon-edit'></i> 修改",[
            "href"=>Url::to(["update", <?= $urlParams ?>]),
            "a"=>true,
            "block"=>true,
            "type"=>"success"
        ]):null?>
        <?= "<?= " ?>$list["delete"] ? Html::tag("lte-btn","<i class='glyphicon glyphicon-remove'></i> 删除",[
            "href"=>Url::to(["delete", <?= $urlParams ?>]),
            "a"=>true,
            "block"=>true,
            "type"=>"danger",
            'data' => [
                'confirm' => Yii::t('yii', '是否要删除这个项目?'),
                'method' => 'post',
            ]
        ]):null?>
        <?= "<?= " ?>Html::tag("lte-btn","<i class='glyphicon glyphicon-share-alt'></i> 返回",[
            "href"=>"javascript:history.go(-1)",
            "a"=>true,
            "block"=>true,
            "type"=>"warning"
        ])?>
    </div>
</component-template>

<script>
    Vue.component('model-options', {
        template: '{{component-template}}'
    });
</script>


