<?php
namespace vuelte\lte\lib;

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
     * @param $model
     * @param $attribute
     * @return string
     */
    public function getName($attribute){
        return Html::getInputName($this->model, $attribute);
    }

    /**
     * @param $model
     * @param $attribute
     * @return string
     */
    public function getLabel($attribute){
        return Html::encode($this->model->getAttributeLabel($attribute));
    }

    /**
     * @param $model
     * @param $attribute
     * @return mixed
     */
    public function getError($attribute){
        return $this->model->getFirstError($attribute);
    }
}
