Vue.component('lte-sidebar-items', {
    props:{
        'nodes':{ type: Array, default: function(){ return []; }}
    },
    template: `<ul class="treeview-menu" v-if="nodes">
        <template v-for="item in nodes">
            <li :class="[item.active?'active':'',item.nodes?'treeview':'']">
                <a :href="item.nodes?'#':item.url">
                    <i class="fa fa-circle-o"></i> <span>{{item.title}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right" v-if="item.nodes"></i>
                        <span class="label label-primary pull-right" v-for="tag in item.tags" :class="tag.class">{{tag.content}}</span>
                    </span>
                </a>
                <lte-sidebar-items :nodes="item.nodes" v-if="item.nodes"></lte-sidebar-items>
            </li>
        </template>
    </ul>`
});