<?php
namespace vuelte\widgets;

use yii\helpers\Html;

class ActiveElementField extends \yii\widgets\ActiveField {
    /**
     * @var string
     */
    public $template = "{label}\n{input}\n{hint}\n{error}";

    /**
     * @param string $name
     * @param array $params
     * @return ActiveElementField
     */
    public function __call($name, $params)
    {
        $element = $this->el_element($name, $params[0] ,$params[1]);
        return $this->el_fieldItem($element);
    }

    /**
     * @param $element
     * @param null $v_model
     * @param array $options
     * @return string
     */
    private function el_element($element ,$v_model = null, $options = []){
        $options = array_merge($options,[
            "name" => Html::getInputName($this->model, $this->attribute),
            "value" => $this->model->{$this->attribute},
            "v-model" => $v_model ? $v_model : null,
        ]);
        $element = Html::tag($element, null, $options);
        return $element;
    }

    /**
     * @param $content
     * @return $this
     */
    private function el_fieldItem($content, $options = []){
        if ($this->form->validationStateOn === ActiveElementForm::VALIDATION_STATE_ON_INPUT) {
            $this->addErrorClassIfNeeded($options);
        }

        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);

        //设置模板
        $this->parts['{input}'] = $content;

        //返回
        return $this;
    }

    /**
     * @param $element
     * @param null $vmodel
     * @param array $options
     * @return $this
     */
    private function el_formItem($content, $options = []){
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

        //设置模板
        $this->template = "{input}";
        $this->parts['{input}'] = implode("\n",$html);

        //返回
        return $this;
    }

    //region 组件元素

    /**
     * @param null $v_model
     * @param array $options
     * @return ActiveElementField
     */
    public function el_input($v_model = null, $options = []){
        $element = $this->el_element("el-input", $v_model ,$options);
        return $this->el_fieldItem($element);
    }

    /**
     * @param null $v_model
     * @param array $options
     * @return ActiveElementField
     */
    public function el_textarea($v_model = null, $options = []){
        $options = array_merge($options,["type" => "textarea"]);
        $element = $this->el_element("el-input", $v_model ,$options);
        return $this->el_fieldItem($element);
    }

    /**
     * @param null $v_model
     * @param array $options
     * @return ActiveElementField
     */
    public function el_switch($v_model = null, $options = []){
        $element = $this->el_element("bootstrap-switch", $v_model ,$options);
        $element = Html::tag("div",$element);
        return $this->el_fieldItem($element);
    }

    /**
     * @param null $vmodel
     * @param array $items
     * @param array $options
     * @return $this
     */
    public function el_select($vmodel = null, $items = [], $options = []){
        //options
        $options = array_merge($options,[
            "name" => Html::getInputName($this->model, $this->attribute),
            "value" => $this->model->{$this->attribute},
            "v-model" => $vmodel ? $vmodel : null,
            "style" => "width:100%",
        ]);

        //construct
        $html[] = Html::beginTag("el-select",$options);
        foreach ($items as $key => $value){
            $html[] = Html::tag("el-option",null,[
                "value" => $key,
                "label" => $value,
            ]);
        }
        $html[] = Html::endTag("el-select");

        //return
        $element = implode("\n",$html);
        return $this->el_fieldItem($element);
    }

    /**
     * @param $items
     * @param null $vmodel
     * @param array $options
     * @return $this
     */
    public function el_checkboxList($vmodel = null, $items = [], $options = []){
        //options
        $options = array_merge($options,["v-model" => $vmodel ? $vmodel : null]);

        //construct
        $html[] = Html::beginTag("el-checkbox-group", $options);
        foreach ($items as $key => $value){
            $html[] = Html::tag("el-checkbox",$key,[
                "name" =>Html::getInputName($this->model, $this->attribute),
                "value" => $key,
                "label" => $value,
            ]);
        }
        $html[] = Html::endTag("el-checkbox-group");

        //return
        $element = implode("\n",$html);
        return $this->el_fieldItem($element);
    }

    //endregion
}
