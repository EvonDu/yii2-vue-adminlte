Vue.component('lte-paginate-box', {
    props:{
        'rowCount'      : {type: Number, default: 20 },
        'page'          : {type: Number, default: 1 },
        'pageSize'      : {type: Number, default: 20 },
        'pageCount'     : {type: Number, default: 1 },
        'totalCount'    : {type: Number, default: 6 },
        'maxCount'      : {type: Number, default: 10 },
        'pageParam'     : {type: String, default: "page"},
        'previousText'  : {type: String, default: "上一页"},
        'nextText'      : {type: String, default: "下一页"},
        'firstText'     : {type: String, default: "首页"},
        'lastText'      : {type: String, default: "尾页"},
    },
    computed: {
        rowFirst: function() {
            return ((this.page-1) * this.pageCount) + 1;
        },
        rowLast: function () {
            return ((this.page-1) * this.pageCount) + this.rowCount;
        }
    },
    render: function(createElement){
        //分页信息
        var text = "显示第 " + this.rowFirst + " 到第 " + this.rowLast + " 条记录，总共 " + this.rowCount + " 条记录";
        var info = createElement('lte-col',
            {
                'props': {
                    "col" : "5"
                },
                'style': {
                    'padding-top' : "8px",
                    "white-space" : "normal"
                }
            }, text);

        //分页导航
        var nav = createElement('lte-paginate', { 'props': this.$props, 'style': { 'margin' : "0" } });
        var paginate = createElement('lte-col',
            {
                'props': { "col" : "7" },
                'style': {
                    'padding-top' : "8px",
                    "white-space" : "normal",
                    "text-align" : "right",
                }
            }, [nav]);

        //返回行
        return createElement('lte-row', {}, [info, paginate]);
    },
});