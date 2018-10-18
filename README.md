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
    //用户按钮
    'userButtons' => [
        ['text' => '用户信息', 'url' => '#'],
        ['text' => '修改密码', 'url' => '#'],
        ['text' => '我的收藏', 'url' => '#'],
    ],
    //配置简介
    'profile' => ['text' => '设置', 'url' => '#'],
    //配置登出
    'signOut' => ['text' => '退出', 'url' => '#'],
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

## Yii与Vue结合使用
#### 变量转化
* 本库中提供将PHP变量转化成JavaScript变量的辅助函数，变量转化后可以便于Vue对其进行操作
* 实现方式为使用`yii\web\View`中的`registerJs`函数，把变量定义到JavaScript中
* 变量转换使用`vuelte\lib\Import::value()`（在视图层中使用）
    * 示例：`vuelte\lib\Import::value($this, $model, "data");`
    * 第一个参数为`yii\web\View`对象，即视图层的`$this`
    * 第二个参数是要转换PHP变量
    * 第三个参数为转换成JavaScript后变量的名称
#### 表单提交
* Yii的默认表单提交方式为"同步跳转式提交"
* 本库提供把JavaScript对象以表单形式提交的辅助函数`YiiFormSubmit()`
    * 示例：`YiiFormSubmit({'name':'test'}, "Demo");`
    * 第一个参数为提交的JavaScript对象
    * 第二个参数为Yii中的模型名（用于迎合Yii的表单提交方式）
    * 示例执行后POST的数据为：`Demo[name]=test`

## 编写Vue组件（PHP混编组件）
#### 实现概述
* 组件的实现，扩展自Yii的`$view->render($path, $params)`,故支持PHP参数传递和混编
* 组件模板部分使用`component-template`标签，javascript和style部分照旧用`script`和`style`标签
* 组件导入使用`vuelte\lib\Import::component()`（在视图层中使用）
    * 示例：`vuelte\lib\Import::component($this,'@app/views/components/avatar',[]);`
    * 第一个参数为`yii\web\View`对象，即视图层的`$this`
    * 第二个参数为编写的组件
    * 第三个参数为PHP参数的key-value数组
* 在组件模板部分（`component-template`标签内）暂不支持单引号
* 在Vue组件中`template`的值必须为：`template: '{{component-template}}'`（注意这里用单引号）
* 可以配置好GII后用模板生成CRUD，然后对照其中的_form文件查看（此为一个完整混编Vue组件）

#### 组件例子
* 示例组件（路径：backend/views/components/test.php）：
```
<!-- 组件样式 -->
<style>
    .test{  color: red; }
</style>
<!-- 组件模板 -->
<component-template>
    <div class="test">
        {{value}} <?="支持PHP混编"?>
    </div>
</component-template>
<!-- 组件代码 -->
<script>
    Vue.component('test', {
        template: '{{component-template}}',
        model: { prop: 'value', event: 'change'},
        props:{
            'value':{ type: String, default: "Demo Component"}
        }
    });
</script>
```
* 使用方法（在Yii的视图层使用）：
 ```
 <?php
 vuelte\lib\Import::component($this,'@backend/views/components/test');
 ?>
 <div id="app">
     <test></test>
 </div>
 
 <script>
     new Vue({
         el:'#app',
         data:{}
     })
 </script>
 ```

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