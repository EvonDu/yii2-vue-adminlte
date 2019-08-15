Vue.component('lte-sidebar', {
    props:{
        'user': {
            type: Object,
            default: function(){
                return {
                    'name': "User",
                    'image': "https://adminlte.io/themes/AdminLTE/dist/img/user8-128x128.jpg",
                    'job': "Developer",
                    'abstract': 'Member since Nov. 2012'
                }
            }
        },
        'nav':{
            type: Array,
            default: function(){
                return [
                    {
                        "title": "MAIN NAVIGATION",
                        "header": true
                    },
                    {
                        "url": "#",
                        "title": "导航一",
                        "icon": "fa fa-dashboard",
                        "active": true,
                        "tags": [
                            {"content": "new", "class": ""},
                            {"content": "new2", "class": "bg-green"}
                        ],
                        "nodes": [
                            {"title": "导航1", "url": "#"}
                        ]
                    },
                    {
                        "url": "https://adminlte.io/docs",
                        "title": "导航二",
                        "icon": "fa fa-dashboard",
                    }
                ]
            }
        }
    },
    data:function(){
        return {};
    },
    created:function(){
        var url = window.location.href.replace(/%2F/g,"/");
        set_active(this.nav,url) || set_active_dir(this.nav,url);
        function set_active(nodes,url){
            for(var key in nodes){
                var node = nodes[key];
                if(node.nodes){
                    //递归结果
                    if(set_active(node.nodes,url)){
                        node["active"] = true;
                        return true;
                    }
                }
                else{
                    if(node.url){
                        //处理url
                        var exp = node.url
                            .replace(/%2F/g,"/")
                            .replace(/-/g,"\-")
                            .replace(/\./g,"\\.")
                            .replace(/\*/g,"\\*")
                            .replace(/\^/g,"\\^")
                            .replace(/\?/g,"\\?")
                            .replace(/\$/g,"\\$");

                        //建立正则表达式并判断
                        if(url.match(exp)){
                            node["active"] = true;
                            return true;
                        }
                    }
                }
            }
            return false;
        };
        function set_active_dir(nodes,url){
            for(var key in nodes){
                var node = nodes[key];
                if(node.nodes){
                    //递归结果
                    if(set_active_dir(node.nodes,url)){
                        node["active"] = true;
                        return true;
                    }
                }
                else{
                    if(node.url){
                        //处理url
                        var exp = node.url
                            .replace(/%2F/g,"/")
                            .replace(/-/g,"\-")
                            .replace(/\./g,"\\.")
                            .replace(/\*/g,"\\*")
                            .replace(/\^/g,"\\^")
                            .replace(/\?/g,"\\?")
                            .replace(/\$/g,"\\$");

                        //处理成父级
                        exp = exp.slice(0,exp.lastIndexOf("/"));

                        //建立正则表达式并判断
                        if(url.match(exp+"/")){
                            node["active"] = true;
                            return true;
                        }
                    }
                }
            }
            return false;
        };
    },
    template: `<aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel" v-if="user">
                <div class="pull-left image">
                    <img :src="user.image" class="img-circle">
                </div>
                <div class="pull-left info">
                    <p>{{user.name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>
            <ul class="sidebar-menu" data-widget="tree">
                <template v-for="item in nav">
                    <li v-if="item.header" class="header">{{item.title}}</li>
                    <li v-else :class="[item.active?'active':'',item.nodes?'treeview':'']">
                        <a :href="item.nodes?'#':item.url">
                            <i :class="item.icon"></i> <span>{{item.title}}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right" v-if="item.nodes"></i>
                                <span class="label label-primary pull-right" v-for="tag in item.tags" :class="tag.class">{{tag.content}}</span>
                            </span>
                        </a>
                        <lte-sidebar-items :nodes="item.nodes"></lte-sidebar-items>
                    </li>
                </template>
            </ul>
        </section>
    </aside>`
});