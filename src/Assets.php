<?php

namespace vuelte;

use Yii;

class Assets
{
    static protected function init(){
        Yii::setAlias('@vuelte',__DIR__);
    }

    static public function layout($name){
        self::init();
        return "@vuelte/layouts/$name.php";
    }

    static public function view($name){
        self::init();
        return "@vuelte/views/$name";
    }

    static public function template(){
        self::init();
        return "@vuelte/template";
    }
}