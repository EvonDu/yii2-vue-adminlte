<?php
namespace vuelte\widgets;

use yii\helpers\Html;

class ActiveElementField extends \yii\widgets\ActiveField {
    /**
     * @param string $name
     * @param array $params
     * @return ActiveElementField
     */
    public function __call($name, $params)
    {
        if(substr($name,0,3) == "el_"){
            //get element
            $name = substr($name,3);
            $name = preg_replace_callback('/([A-Z]{1})/',function($matches){return '-'.strtolower($matches[0]);},$name);
            //create element
            $element = $this->el_element("el-".$name, $params[0]);
            return $this->el_formItem($element);
        }
        else{
            return parent::__call($name,$params);
        }
    }

    /**
     * @param $content
     * @param array $options
     * @return $this
     */
    private function el_formItem($content){
        //获取 label 和 error
        $label = Html::encode($this->model->getAttributeLabel($this->attribute));
        $error = $this->model->getFirstError($this->attribute);

        //设置Html
        $html[] = Html::beginTag("el-form-item",[
            "label"=>$label,
            "prop"=>$this->attribute,
            "error"=>$error
        ]);
        $html[] = $content;
        $html[] = Html::endTag("el-form-item");

        //返回
        return implode("\n",$html);
    }

    /**
     * @param $element
     * @param null $v_model
     * @param array $options
     * @return string
     */
    private function el_element($element, $options = []){
        //$options['value'] = $this->model->{$this->attribute};
        //$options['v-model'] = $v_model ? $v_model : null;
        $options['name'] = Html::getInputName($this->model, $this->attribute);
        $element = Html::tag($element, null, $options);
        return $element;
    }

    //region Element元素

    /**
     * @param $items
     * @param array $options
     * @return ActiveElementField
     */
    public function el_select($items, $options = []){
        //construct
        $html[] = Html::beginTag("el-select",$options);
        foreach ($items as $key => $value){
            $option_attr = ["label" => $value];
            if(is_string($this->model->{$this->attribute}))
                $option_attr["value"] = "$key";
            else
                $option_attr[":value"] = "$key";
            $html[] = Html::tag("el-option",null,$option_attr);
        }
        $html[] = Html::endTag("el-select");

        //element
        $element = implode("\n",$html);

        //return
        return $this->el_formItem($element);
    }

    //endregion
}
