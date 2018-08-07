<?php
namespace vuelte\widgets;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class ActionColumn extends \yii\grid\ActionColumn {

    public $contentOptions = ["style" => 'white-space: nowrap'];

    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'View'),
                    'aria-label' => Yii::t('yii', 'View'),
                    'data-pjax' => '0',
                    'size'=> 'xs',
                    'href'=> $url,
                    'a'=>true,
                ], $this->buttonOptions);
                $content = " <i class='glyphicon glyphicon-eye-open'></i> ".Yii::t('yii', 'View');
                return Html::tag("lte-btn",$content, $options);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                    'type'=> 'info',
                    'size'=> 'xs',
                    'href'=> $url,
                    'a'=>true,
                ], $this->buttonOptions);
                $content = " <i class='glyphicon glyphicon-pencil'></i> ".Yii::t('yii', 'Update');
                return Html::tag("lte-btn",$content, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'type'=> 'danger',
                    'size'=> 'xs',
                    'href'=> $url,
                    'a'=>true,
                ], $this->buttonOptions);
                $content = " <i class='glyphicon glyphicon-trash'></i> ".Yii::t('yii', 'Delete');
                return Html::tag("lte-btn",$content, $options);
            };
        }
    }
}
