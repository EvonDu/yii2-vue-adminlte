<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yiivue\Import;
use yiilte\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['small'] = 'View';
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

Import::component($this, '_options', ['model' => $model]);
?>
<component-template>
    <lte-sortable :columns="[3,9]">
        <template slot="col_1">
            <lte-box title="选项" icon="fa fa-edit">
                <model-options></model-options>
            </lte-box>
        </template>
        <template slot="col_2">
            <lte-box title="详情" icon="fa fa-eye">

                <?= "<?= " ?>DetailView::widget([
                    'model' => $model,
                    'attributes' => [
<?php
    if (($tableSchema = $generator->getTableSchema()) === false) {
        foreach ($generator->getColumnNames() as $name) {
            echo "                        '" . $name . "',\n";
        }
    } else {
        foreach ($generator->getTableSchema()->columns as $column) {
            $format = $generator->generateColumnFormat($column);
            echo "                        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
?>
                    ],
                ]) ?>

            </lte-box>
        </template>
    </lte-sortable>
</component-template>

<script>
    Vue.component('lte-content', {
        template: '{{component-template}}'
    })
</script>