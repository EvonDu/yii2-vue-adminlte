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
        <?= "<?= " ?>$list["index"] ? Html::tag("lte-btn","列表",[
            "href"=>Url::to(["index"]),
            "a"=>true,
            "block"=>true,
            "icon"=>"glyphicon glyphicon-list"
        ]):null?>
        <?= "<?= " ?>$list["create"] ? Html::tag("lte-btn","添加",[
            "href"=>Url::to(["create"]),
            "a"=>true,
            "block"=>true,
            "type"=>"info",
            "icon"=>"glyphicon glyphicon-plus"
        ]):null?>
        <?= "<?= " ?>$list["update"] ? Html::tag("lte-btn","修改",[
            "href"=>Url::to(["update", <?= $urlParams ?>]),
            "a"=>true,
            "block"=>true,
            "type"=>"success",
            "icon"=>"glyphicon glyphicon-edit"
        ]):null?>
        <?= "<?= " ?>$list["delete"] ? Html::tag("lte-btn","删除",[
            "href"=>"#",
            "a"=>true,
            "block"=>true,
            "type"=>"danger",
            "icon"=>"glyphicon glyphicon-remove",
            "@click" => "toDelete()"
        ]):null?>
        <?= "<?= " ?>Html::tag("lte-btn","返回",[
            "href"=>"javascript:history.go(-1)",
            "a"=>true,
            "block"=>true,
            "type"=>"warning",
            "icon"=>"glyphicon glyphicon-share-alt"
        ])?>
    </div>
</component-template>

<script>
    Vue.component('model-options', {
        template: '{{component-template}}',
        methods: {
            <?= "<? " ?>if($list["delete"]):?>
            toDelete: function(){
                if(!confirm("<?= "<?= " ?>Yii::t('yii', '是否要删除这个项目?')?>"))
                    return;
                this.$yii.submit(null, null, "<?= "<?= " ?>Url::to(["delete", 'id' => $model->id])?>");
            }
            <?= "<? " ?>endif?>
        }
    });
</script>