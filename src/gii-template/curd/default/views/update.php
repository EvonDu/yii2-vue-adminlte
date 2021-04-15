<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yiivue\Import;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= strtr($generator->generateString('Update ' .
    Inflector::camel2words(StringHelper::basename($generator->modelClass)) .
    ': {nameAttribute}', ['nameAttribute' => '{nameAttribute}']), [
    '\'{nameAttribute}\'' => '$model->' . $generator->getNameAttribute()
]) ?>;
$this->params['small'] = 'Update';
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model-><?= $generator->getNameAttribute() ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Update') ?>;

Import::value($this, $model, "model");
Import::component($this, '_options', ['model' => $model]);
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
            <lte-box title="编辑" icon="fa fa-edit">
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
