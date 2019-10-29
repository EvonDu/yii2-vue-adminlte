Vue.component('lte-table-column', {
    props:{
        'prop': {type: String, default: "default"},
        'label': {type: String, default: "default"},
        'dataSource': {type: Object, default: function(){ return {}}}
    },
    computed: {
        value: function () {
            return this.dataSource[this.prop];
        }
    },
    template: '<div><slot :row="dataSource">{{value}}</slot></div>',
});