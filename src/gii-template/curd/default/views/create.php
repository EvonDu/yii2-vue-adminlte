<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yiivue\Import;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['small'] = 'Create';
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Import::value($this, $model, "model");
Import::component($this, '_options');
Import::component($this,'_form', ['model' => $model]);
?>
<component-template>
    <lte-sortable :columns="[3,9]">
        <template slot="col_1">
            <lte-box title="选项" icon="fa fa-edit">
                <model-options></model-options>
            </lte-box>
        </template>
        <template slot="col_2">
            <lte-box title="新增" icon="fa fa-plus">
                <model-form :model="model"></model-form>
            </lte-box>
        </template>
    </lte-sortable>
</component-template>

<script>
    Vue.component('lte-content', {
        template: '{{component-template}}',
        data: function(){
            return {
                "model": model
            }
        }
    })
</script>
