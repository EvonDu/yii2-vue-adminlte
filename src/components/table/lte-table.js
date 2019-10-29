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
                //过滤空白元素
                if(!this.$slots.default[i])
                    continue;
                //过滤非lte-table-column元素
                if(this.$slots.default[i].componentOptions.tag !== "lte-table-column")
                    continue;
                //添加到结果集
                result.push(this.$slots.default[i]);
            }
            return result;
        }
    },
    render: function(createElement){
        //遍历获取th
        var ths = [];
        for(var i in this.columns){
            ths.push(createElement('th',[this.columns[i].componentOptions.propsData.label]));
        }

        //遍历获取td
        var trs = [];
        for(var j in this.items){
            var tds = [];
            var item = this.items[j];
            for(var k in this.columns){
                //过滤空白元素
                if(!this.columns[k])
                    continue;
                //过滤非lte-table-column元素
                if(this.columns[k].componentOptions.tag !== "lte-table-column")
                    continue;
                //创建一个新的lte-table-column并沿用其属性和插槽(子元素)
                var node = createElement('lte-table-column', this.columns[k].data, this.columns[k].children);
                node.componentOptions.propsData = JSON.parse(JSON.stringify(this.columns[k].componentOptions.propsData));
                node.componentOptions.propsData.dataSource = item;
                tds.push(createElement('td',[node]));
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