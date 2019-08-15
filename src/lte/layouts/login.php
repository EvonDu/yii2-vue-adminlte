<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use vuelte\lte\assets\AppAsset;
use vuelte\lte\assets\ElementAsset;
use vuelte\lte\assets\AdminLteComponentsAsset;

//加载资源
AppAsset::register($this);
ElementAsset::register($this);
AdminLteComponentsAsset::register($this);

//读取配置信息
$config = [];
$config_path = Yii::getAlias("@app/config/adminlte.php");
if(file_exists($config_path)){
    $config = include($config_path);
    $config = is_array($config) ? $config : [];
}
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="shortcut icon" href="favicon.ico" />
        <title><?= Html::encode($this->title) ?></title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition login-page">
    <?php $this->beginBody() ?>

    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b><?= isset($config['productName']) ? $config['productName'] : 'Yii AdminLet'?></b></a>
        </div>
        <div class="login-box-body">
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>