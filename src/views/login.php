<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\admin\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->context->layout = '@vuelte/layouts/login.php';
$this->title = '用户登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<p class="login-box-msg">请填写以下登录信息</p>

<?php $form = ActiveForm::begin(); ?>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'username',['template' =>"{input}{error}"])
            ->textInput(["placeholder"=>$model->getAttributeLabel('username')]) ?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <?= $form->field($model, 'password',['template' =>"{input}{error}"])
            ->passwordInput(["placeholder"=>$model->getAttributeLabel('password')]) ?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <?= $form->field($model, 'rememberMe')->checkbox(['class'=>'rememberme check','style'=>'display: inline;']) ?>
        </div>
        <div class="col-xs-4">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block btn-flat']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>