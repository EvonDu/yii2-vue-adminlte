<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yiivue\Import;
use vuelte\assets\ElementAsset;
use vuelte\assets\AdminLteComponentsAsset;

//加载资源
ElementAsset::register($this);
AdminLteComponentsAsset::register($this);

//加载内容组件
Import::componentByContent($this, $content) || Import::componentByHtml($this, $content, "let-content");
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<?php $this->beginBody() ?>

<div id="app" class="wrapper">
    <let-content></let-content>
</div>

<script>
    const vue = new Vue({
        el: '#app'
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
