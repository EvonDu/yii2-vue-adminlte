Vue.component('lte-header', {
    props: {
        'title': {type: String, default: "AdminLTE"},
        'user': {
            type: Object,
            default: function(){
                return {
                    'name': "User",
                    'image': "https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg",
                    'job': "Developer",
                    'abstract':'Member since Nov. 2012'
                }
            }
        },
        'messages':{
            type:Array,
            default: function(){ return [] }//[{"userImage":"https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg", "title":"信息标题", "content":"内容", "time":"5分钟","url":"https://www.baidu.com"}]
        },
        'notifications':{
            type:Array,
            default: function(){ return [] }//[{"icon":"fa fa-users text-aqua","content":"内容","url":"https://www.baidu.com"}]
        },
        'tasks':{
            'type':Array,
            default: function(){ return [] }//[{"progress":"50","content":"内容","url":"https://www.baidu.com"}]
        },
        'urlHome':{'type':String,default:"#"},
        'urlFollowers':{'type':String,default:"#"},
        'urlSales':{'type':String,default:"#"},
        'urlFriends':{'type':String,default:"#"},
        'urlProfile':{'type':String,default:"#"},
        'urlSignout':{'type':String,default:"#"},
    },
    data:function(){
        return {};
    },
    computed: {
        messageCount: function () {
            return this.messages.length;
        },
        notificationCount: function () {
            return this.notifications.length;
        },
        taskCount: function () {
            return this.tasks.length;
        }
    },
    template:`<header class="main-header">
        <a :href="urlHome" class="logo">
            <span class="logo-mini">{{title}}</span>
            <span class="logo-lg">{{title}}</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <!-- 菜单 -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- 信息 -->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success" v-show="messageCount">{{messageCount}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{messageCount}} messages</li>
                            <li>
                                <ul class="menu">
                                    <li v-for="item in messages">
                                        <a :href="item.url">
                                            <div class="pull-left">
                                                <img :src="item.userImage" class="img-circle" v-if="item.userImage">
                                            </div>
                                            <h4>
                                                {{item.title}}
                                                <small><i class="fa fa-clock-o"></i>{{item.time}}</small>
                                            </h4>
                                            <p>{{item.content}}</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">See All Messages</a></li>
                        </ul>
                    </li>
                    <!-- 通知 -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning" v-show="notificationCount">{{notificationCount}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{notificationCount}} notifications</li>
                            <li>
                                <ul class="menu">
                                    <li v-for="item in notifications">
                                        <a :href="item.url">
                                            <i :class="item.icon"></i> {{item.content}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>
                    <!-- 工作 -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger" v-show="taskCount">{{taskCount}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{taskCount}} tasks</li>
                            <li>
                                <ul class="menu">
                                    <li v-for="item in tasks">
                                        <a :href="item.url">
                                            <h3>
                                                {{item.content}}
                                                <small class="pull-right">{{item.progress}}%</small>
                                            </h3>
                                            <div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" :style="'width: '+item.progress+'%'" role="progressbar" :aria-valuenow="item.progress" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only">{{item.progress}}% Complete</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">View all tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- 用户信息 -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img :src="user.image" class="user-image">
                            <span class="hidden-xs">{{user.name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img :src="user.image" class="img-circle">
                                <p>
                                    {{user.name}}<span v-if="user.job"> - {{user.job}}</span>
                                    <small>{{user.abstract}}</small>
                                </p>
                            </li>
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a :href="urlFollowers">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a :href="urlSales">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a :href="urlFriends">Friends</a>
                                    </div>
                                </div>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a :href="urlProfile" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <form :action="urlSignout" method="post">
                                        <button class="btn btn-default btn-flat">Sign out</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>`,
});