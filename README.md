# yii2-vue-adminlet

## 项目介绍
在Yii项目中添加Vue，Vuex进行视图开发，用AdminLte进行Vue组件化后构建Layout，用Element Ui构建相关表单，并提供Gii的Crud生成模板。

## 安装方法
`composer require evondu/yii2-vue-adminlte`

## 配置方法
#### 配置布局
* 配置文件：backend/config/main.php
* `'layout' => vuelte\Assets::layout('main')`

#### 配置布局信息
* 新建配置文件：backend/config/adminlte.php
* 配置内容可以直接设置，也可以通过函数返回和全局属性等，如用户名:`Yii::$app->user->identity->username`
```
<?php
use \yii\helpers\Url;

return [
    //配置名称
    'productName' => 'Yii AdminLet',
    //配置用户
    'user' => [
        'name'=> Yii::$app->user->identity->username,
        'image'=> "https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg",
        'job'=> "Developer",
        'abstract'=> 'Member since Nov. 2012',
    ],
    //配置导航
    'nav' => [
        [ "title"=>"Gii", "header" => true ],
        [
            "url" => "#",
            "title" =>"Yii Code Generator",
            "icon" => "fa fa-dashboard",
            "active" => true,
            "tags" => [["content"=>"Yii", "class"=>"bg-green"]],
            "nodes" => [
                ["title" => "Model Generator", "url" => Url::to(["/gii/default/view","id"=>"model"])],
                ["title" => "CRUD Generator", "url" => Url::to(["/gii/default/view","id"=>"crud"])],
                ["title" => "Module Generator", "url" => Url::to(["/gii/default/view","id"=>"module"])],
            ]
        ]
    ],
    //配置信息
    'messages' => [
        [
            "userImage"=>"https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg",
            "title"=>"",
            "content"=>"点击阅读详细信息",
            "time"=>"5分钟",
            "url"=>"#"
        ],
    ],
    //配置通知
    'notifications' => [
        [
            "icon"=>"fa fa-users text-aqua",
            "content"=>"数据同步已经完成",
            "url"=>"#"
        ]
    ],
    //配置任务
    'tasks' => [
        [
            "progress" => "68",
            "content"=>"后端开发",
            "url"=>"#",
        ]
    ],
    //配置页脚
    'footer' => '<strong>Copyright &copy; 2017-2018 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.',
];
?>
```

#### 配置GII的CRUD生成器
* 配置文件：backend/config/main.php
```
return [
    ……
    'modules' => [
        'gii'=>[
            'class' => 'yii\gii\Module',
            'generators' => [
                'crud' => [
                    'class' => 'yii\gii\generators\crud\Generator',
                    'templates' => [
                        'vuelte' => vuelte\Assets::template(),
                    ]
                ]
            ],
        ]
    ]
    ……
]
```

#### 配置特定页面
配置使用固定特定页面（针对原始的Yii项目作说明）：
* 主页：
    * 配置文件：backend/controllers/SiteController.php
    * 配置actionIndex方法，修改return调用的视图就可以
    * `return $this->render(\vuelte\Assets::view('home'));`
* 登录页：
    * 配置文件：backend/controllers/SiteController.php
    * 配置控制器关闭CSRF认证：`public $enableCsrfValidation = false;`
    * 配置actionLogin方法，修改return调用的视图就可以
    * `return $this->render(\vuelte\Assets::view('login'), [ 'model' => $model ]);`

## 项目架构
```
src
    assets/                 Yii的Asset类
    components/             AdminLte的Vue组件
    layouts/                Yii的布局文件
    resource/               前端资源集合
    template/               Gii的Crud模板
    tools/                  辅助类
    views/                  视图模板
    widgets/                Yii的Widget扩展
```

## 参与贡献
1. Fork 本项目
2. 新建 Feat_xxx 分支
3. 提交代码
4. 新建 Pull Request