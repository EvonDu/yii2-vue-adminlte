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
use vuelte\lte\lib\ModelFields;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

$fields = new ModelFields($model);
?>
<component-template>
    <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
        <el-form label-width="100px" status-icon>
<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "        " . generateVueActiveField($attribute, $generator) . " \n\n";
    }
} ?>
            <el-form-item>
                <lte-btn type="info" @click="submit"><i class="glyphicon glyphicon-floppy-disk"></i> 保存</lte-btn>
            </el-form-item>
        </el-form>
    </div>
</component-template>

<script>
    Vue.component('model-form', {
        template: '{{component-template}}',
        props:{
            model:{ type: Object, default: function(){ return {}; }}
        },
        methods: {
            submit: function (event) {
                YiiFormSubmit(this.model, "<?= $model->formName()?>");
            }
        }
    });
</script>


<?php
    function generateVueActiveField($attribute,yii\gii\generators\crud\Generator $generator){
        $tableSchema = $generator->getTableSchema();
        $column = $tableSchema->columns[$attribute];
        if ($column->phpType === 'boolean') {
            $html[] = '    <el-form-item prop="'.$attribute.'" label="<?= $fields->getLabel("'.$attribute.'")?>" error="<?= $fields->getError("'.$attribute.'")?>">';
            $html[] = '                <el-input v-model="model.'.$attribute.'" type="password"></el-input>';
            $html[] = '            </el-form-item>';
            return implode("\n",$html);
        }

        if ($column->type === 'text') {
            $html[] = '    <el-form-item prop="'.$attribute.'" label="<?= $fields->getLabel("'.$attribute.'")?>" error="<?= $fields->getError("'.$attribute.'")?>">';
            $html[] = '                <el-input v-model="model.'.$attribute.'" type="textarea" rows="6"></el-input>';
            $html[] = '            </el-form-item>';
            return implode("\n",$html);
        }

        if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
            $html[] = '    <el-form-item prop="'.$attribute.'" label="<?= $fields->getLabel("'.$attribute.'")?>" error="<?= $fields->getError("'.$attribute.'")?>">';
            $html[] = '                <el-input v-model="model.'.$attribute.'" type="password"></el-input>';
            $html[] = '            </el-form-item>';
            return implode("\n",$html);
        }

        $html[] = '    <el-form-item prop="'.$attribute.'" label="<?= $fields->getLabel("'.$attribute.'")?>" error="<?= $fields->getError("'.$attribute.'")?>">';
        $html[] = '                <el-input v-model="model.'.$attribute.'"></el-input>';
        $html[] = '            </el-form-item>';
        return implode("\n",$html);
    }
?>