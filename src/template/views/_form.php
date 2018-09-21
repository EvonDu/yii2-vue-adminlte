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

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<component-template>
    <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

        <?= "<?php " ?>ActiveElementForm::begin(["options"=>[
            "label-width" => "100px",
            "status-icon" => true,
        ]]); ?>

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "    " . generateVueActiveField($attribute, $generator) . " \n\n";
    }
} ?>
        <el-form-item>
            <lte-btn type="info" @click="submit"><i class="glyphicon glyphicon-floppy-disk"></i> 保存</lte-btn>
        </el-form-item>

        <?= "<?php " ?>ActiveElementForm::end(); ?>

    </div>
</component-template>

<script>
    Vue.component('model-form', {
        template: '{{component-template}}',
        props:{
            data:{ type: Object, default: function(){ return {}; }}
        },
        methods: {
            submit: function (event) {
                YiiFormSubmit(this.data, "<?= $model->formName()?>");
            }
        }
    });
</script>


<?php
    function generateVueActiveField($attribute,yii\gii\generators\crud\Generator $generator){
        $tableSchema = $generator->getTableSchema();
        $column = $tableSchema->columns[$attribute];
        if ($column->phpType === 'boolean') {
            $html[] = '    <el-form-item prop="'.$attribute.'"';
            $html[] = '                      label="<?= ActiveElementForm::getFieldLabel($model,"'.$attribute.'")?>"';
            $html[] = '                      error="<?= ActiveElementForm::getFieldError($model,"'.$attribute.'")?>">';
            $html[] = '            <el-input v-model="data.'.$attribute.'" type="password"></el-input>';
            $html[] = '        </el-form-item>';
            return implode("\n",$html);
        }

        if ($column->type === 'text') {
            $html[] = '    <el-form-item prop="'.$attribute.'"';
            $html[] = '                      label="<?= ActiveElementForm::getFieldLabel($model,"'.$attribute.'")?>"';
            $html[] = '                      error="<?= ActiveElementForm::getFieldError($model,"'.$attribute.'")?>">';
            $html[] = '            <el-input v-model="data.'.$attribute.'" type="textarea" rows="6"></el-input>';
            $html[] = '        </el-form-item>';
            return implode("\n",$html);
        }

        if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
            $html[] = '    <el-form-item prop="'.$attribute.'"';
            $html[] = '                      label="<?= ActiveElementForm::getFieldLabel($model,"'.$attribute.'")?>"';
            $html[] = '                      error="<?= ActiveElementForm::getFieldError($model,"'.$attribute.'")?>">';
            $html[] = '            <el-input v-model="data.'.$attribute.'" type="password"></el-input>';
            $html[] = '        </el-form-item>';
            return implode("\n",$html);
        }

        $html[] = '    <el-form-item prop="'.$attribute.'"';
        $html[] = '                      label="<?= ActiveElementForm::getFieldLabel($model,"'.$attribute.'")?>"';
        $html[] = '                      error="<?= ActiveElementForm::getFieldError($model,"'.$attribute.'")?>">';
        $html[] = '            <el-input v-model="data.'.$attribute.'"></el-input>';
        $html[] = '        </el-form-item>';
        return implode("\n",$html);
    }
?>