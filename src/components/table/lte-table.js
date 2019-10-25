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
    render: function(createElement){
        //遍历获取th
        var ths = [];
        for(var i in this.columns){
            var column = this.columns[i];
            ths.push(createElement('th',[column.label]));
        }

        //遍历获取td
        var trs = [];
        for(var j in this.items){
            var item = this.items[j];
            var tds = [];
            for(var k in this.columns){
                var column = this.columns[k];
                tds.push(createElement('td',item[column.prop]));
                //console.log(this.$slots.default[k]);
                //console.log(this.$slots.default[k].componentInstance);
                //tds.push(createElement('td',[this.$slots.default[k]]));
            }
            trs.push(createElement('tr', tds))
        }

        //创建thead
        var thead = createElement('thead', [createElement('tr', ths)]);

        //创建tbody
        var tbody = createElement('thead', trs);

        //创建返回table
        return createElement(
            'table',
            { 'class': this.tableClass },
            [thead, tbody]
        );
    }
});