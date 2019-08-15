Vue.component('lte-nav', {
    props:{
        'nodes':{
            type: Array,
            default: function(){
                return [
                    {
                        "url": "#",
                        "title": "Node1",
                        "icon": "fa fa-dashboard",
                        "bg":"green",
                    },
                    {
                        "url": "#",
                        "title": "Node2",
                        "icon": "fa fa-inbox",
                        "bg":"red",
                    }
                ]
            }
        }
    },
    computed: {},
    template: `<ul class="nav nav-pills nav-stacked">
            <li v-for="item in nodes"><a :href="item.url?item.url:'#'" :class="'bg-' + item.bg"><i :class="item.icon" v-if="item.icon"></i> {{item.title}}</a></li>
        </ul>`
});