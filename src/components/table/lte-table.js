Vue.component('lte-table', {
    props:{
        'items': {type: Array, default: function(){ return [] }},
        'hover': {type: Boolean, default: true},
        'striped': {type: Boolean, default: true},
        'bordered': {type: Boolean, default: true},
        'dataTable': {type: Boolean, default: false}
    },
    computed: {
        tableClass: function() {
            var tableClass = {};
            tableClass['table']             = true;
            tableClass['table-hover']       = this.hover;
            tableClass['table-striped']     = this.striped;
            tableClass['table-bordered']    = this.bordered;
            tableClass['dataTable']         = this.dataTable;
            return tableClass;
        },
        columns: function () {
            var result = [];
            for (var i in this.$slots.default){
                var item = this.$slots.default[i];
                if(item.componentOptions){
                    var data = item.componentOptions.propsData || null;
                    result.push(data)
                }
            }
            return result;
        }
    },
    template: `<table :class="tableClass">
    <thead>
        <tr><th v-for="(column,key) in columns">{{column.label}}</th></tr>
    </thead>
    <tbody>
        <tr v-for="(item,key) in items">
            <td v-for="(column,key) in columns">{{item[column.prop]}}</td>
        </tr>
    </tbody>
</table>`
});