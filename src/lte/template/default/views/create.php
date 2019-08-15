<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use vuelte\vue\Import;

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
    <lte-row>
        <lte-col col="3">
            <lte-box title="选项" icon="fa fa-edit">
                <model-options></model-options>
            </lte-box>
        </lte-col>
        <lte-col col="9">
            <lte-box title="新增" icon="fa fa-plus">
                <model-form :model="model"></model-form>
            </lte-box>
        </lte-col>
    </lte-row>
</component-template>

<script>
    Vue.component('let-content', {
        template: '{{component-template}}',
        data: function(){
            return {
                "model": model
            }
        }
    })
</script>
