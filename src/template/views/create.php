<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['small'] = 'Create';
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

vuelte\tools\VarConvert::run($this, $model, "data");
?>
<div id="app">
    <lte-row>
        <lte-col col="3">
            <lte-box title="Button" icon="fa fa-edit">
                <?= "<?= " ?>Html::tag("lte-btn","<i class='glyphicon glyphicon-list'></i> 列表",[
                "href"=>Url::to(["index"]),
                "a"=>true,
                "block"=>true,
                ])?>
                <?= "<?= " ?>Html::tag("lte-btn","<i class='glyphicon glyphicon-share-alt'></i> 返回",[
                "href"=>"javascript:history.go(-1)",
                "a"=>true,
                "block"=>true,
                "type"=>"warning"
                ])?>
            </lte-box>
        </lte-col>
        <lte-col col="9">
            <lte-box title="Add" icon="fa fa-plus">

                <?= "<?= " ?>$this->render('_form', [
                'model' => $model,
                ]) ?>

            </lte-box>
        </lte-col>
    </lte-row>
</div>

<script>
    new Vue({
        el:'#app',
        data:{
            data:data,
        }
    })
</script>
