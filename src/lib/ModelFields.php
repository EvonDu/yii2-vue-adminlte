<?php
namespace yiilte\lib;

use yii\helpers\Html;

class ModelFields{
    /**
     * @var
     */
    private $model;

    /**
     * ModelField constructor.
     * @param $model
     */
    public function __construct($model){
        $this->model = $model;
    }

    /**
     * @param $attribute
     * @return string
     */
    public function getName($attribute){
        return Html::getInputName($this->model, $attribute);
    }

    /**
     * @param $attribute
     * @return string
     */
    public function getLabel($attribute){
        return Html::encode($this->model->getAttributeLabel($attribute));
    }

    /**
     * @param $attribute
     * @return mixed
     */
    public function getError($attribute){
        $error = $this->model->getFirstError($attribute);
        $error = preg_replace("/('|\"){1}/", "`", $error);
        return $error;
    }
}
