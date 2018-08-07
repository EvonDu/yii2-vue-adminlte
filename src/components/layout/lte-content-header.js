Vue.component('lte-content-header', {
    props:{
        'small': {type: String, default: ""},
        'breadcrumbs': {
            type: Array,
            default:function(){
                return [{'label':'node',"url":"#"}];
            }
        },
    },
    template: `<section class="content-header">
        <h1>
            <slot></slot>
            <small>{{small}}</small>
        </h1>
        <ol class="breadcrumb">
            <li v-for="(item,index) in breadcrumbs" :class="{'active':(breadcrumbs.length-1 == index)}">
                <template v-if="breadcrumbs.length-1 != index">
                    <a :href="item.url">
                        <i :class="item.icon" v-if="item.icon"></i> 
                        {{item.label}}
                    </a>
                </template>
                <template v-else>
                    <i :class="item.icon" v-if="item.icon"></i> 
                    {{item.label}}
                </template>
            </li>
        </ol>
    </section>`
});