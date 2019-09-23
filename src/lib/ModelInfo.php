<?php
namespace yiilte\lib;

use yii\base\Model;

class ModelInfo{
    /**
     * 获取模型信息
     * @param Model $model
     * @return array
     */
    public static function get(Model $model){
        //定义返回
        $result = [];

        //获取所有key和label
        foreach ($model->attributeLabels() as $key => $label){
            $result[$key] = [
                "label" => $label
            ];
        }

        //获取错误
        foreach ($model->errors as $key => $error){
            if(!isset($result[$key]))
                $result[$key] = [];
            $result[$key]["error"] = $error[0];
        }

        //返回结果
        return $result;
    }
}
