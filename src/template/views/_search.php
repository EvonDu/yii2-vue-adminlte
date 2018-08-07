<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use vuelte\widgets\ActiveElementForm;

vuelte\assets\PluginComponentsAsset::register($this);

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search">

    <?= "<?php " ?>$form = ActiveElementForm::begin([
        'action' => ['index'],
        'method' => 'get',
<?php if ($generator->enablePjax): ?>
        'options' => [
            'data-pjax' => 1
        ],
<?php endif; ?>
    ]); ?>

<?php
$count = 0;
foreach ($generator->getColumnNames() as $attribute) {
    if (++$count < 6) {
        echo "    <?= " . generateActiveSearchField($attribute, $generator) . " ?>\n\n";
    } else {
        echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
    }
}
?>
    <div class="form-group">
        <?= "<?= " ?>Html::tag("lte-btn","<i class='glyphicon glyphicon-search'></i> 搜索",["type" => "primary", "submit" => true]) ?>
    </div>

    <?= "<?php " ?>ActiveElementForm::end(); ?>

</div>

<?php
function generateActiveSearchField($attribute,yii\gii\generators\crud\Generator $generator)
{
    $tableSchema = $generator->getTableSchema();
    if ($tableSchema === false) {
        return "\$form->field(\$model, '$attribute')->el_input()";
    }

    $column = $tableSchema->columns[$attribute];
    if ($column->phpType === 'boolean') {
        return "\$form->field(\$model, '$attribute')->el_switch()";
    }

    return "\$form->field(\$model, '$attribute')->el_input()";
}

?>