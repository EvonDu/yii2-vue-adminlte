<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use vuelte\widgets\ActiveElementForm;

vuelte\assets\PluginComponentsAsset::register($this);

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

    <?= "<?php " ?>$form = ActiveElementForm::begin(["options"=>[
        "label-width" => "100px",
        "status-icon" => true,
    ]]); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    <?= " . generateVueActiveField($attribute, $generator) . " ?>\n\n";
    }
} ?>
    <el-form-item>
        <?= "<?= " ?>Html::tag("lte-btn","<i class='glyphicon glyphicon-floppy-disk'></i> 保存",["type" => "info", "@click" => "submit"]) ?>
    </el-form-item>

    <?= "<?php " ?>ActiveElementForm::end(); ?>

</div>

<?php
    function generateVueActiveField($attribute,yii\gii\generators\crud\Generator $generator){
        $tableSchema = $generator->getTableSchema();
        if ($tableSchema === false || !isset($tableSchema->columns[$attribute])) {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $attribute)) {
                return "\$form->field(\$model, '$attribute')->el_input('data.$attribute', ['type' => 'password'])";
            }

            return "\$form->field(\$model, '$attribute')";
        }
        $column = $tableSchema->columns[$attribute];
        if ($column->phpType === 'boolean') {
            return "\$form->field(\$model, '$attribute')->el_switch(['v-model' => 'data.$attribute'])";
        }

        if ($column->type === 'text') {
            return "\$form->field(\$model, '$attribute')->el_textarea(['v-model' => 'data.$attribute', 'rows' => 6])";
        }

        if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
            $input = 'password';
        } else {
            $input = 'input';
        }

        if (is_array($column->enumValues) && count($column->enumValues) > 0) {
            $dropDownOptions = [];
            foreach ($column->enumValues as $enumValue) {
                $dropDownOptions[$enumValue] = Inflector::humanize($enumValue);
            }
            return "\$form->field(\$model, '$attribute')->el_select("
                . preg_replace("/\n\s*/", ' ', VarDumper::export($dropDownOptions)).", ['v-model' => 'data.$attribute', 'prompt' => ''])";
        }

        if ($column->phpType !== 'string' || $column->size === null) {
            return "\$form->field(\$model, '$attribute')->el_input(['v-model' => 'data.$attribute', 'type' => '$input'])";
        }

        return "\$form->field(\$model, '$attribute')->el_input(['v-model' => 'data.$attribute', 'maxlength' => true])";
    }
?>