Vue.component('lte-paginate', {
    props:{
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
    data: function(){
        return {
            "showFirst": undefined,
            "showCount": undefined,
            "paramsStr": undefined,
        }
    },
    created: function(){
        this.showFirst = this.getShowFirst();
        this.showCount = this.getShowCount();
        this.paramsStr = this.getParamsStr();
    },
    methods: {
        getShowFirst:function(){
            var n1 = this.page > Math.floor(this.maxCount/2) ? (this.page - Math.floor(this.maxCount/2)) : 1;
            var n2 = this.totalCount > this.maxCount ? (this.totalCount - this.maxCount +1) : 1;
            return Math.min(n1 ,n2)
        },
        getShowCount:function(){
            return Math.min(this.totalCount ,this.maxCount)
        },
        getParamsStr:function(){
            var str = window.location.search ? (window.location.search).substring(1) : "";
            var list = str.split('&');
            var params = {};
            for (var i in list){
                var items = list[i].split('=');
                params[items[0]] = items[1];
            }

            var params_str = '';
            for (var i in params){
                if(i !== this.pageParam){
                    params_str += params_str === "" ? "" : "&";
                    params_str += i + "=" + params[i]
                }
            }

            return params_str;
        },
        getPageUrl: function(page){
            return window.location.origin + window.location.pathname + "?" + this.paramsStr + "&page=" + page
        },
    },
    render: function(createElement){
        //遍历获取th
        var lis = [];

        //添加首页
        if(this.page > 1){
            var a_previous = createElement('a', { 'attrs': { 'href' : this.getPageUrl(this.page - 1) } }, this.previousText);
            lis.push(createElement('li', { 'class': 'paginate_button previous' }, [a_previous]));
        }

        //添加分页
        for (var i=0;i<this.showCount;i++){
            var li_page     = this.showFirst + i;
            var li_class    = li_page === this.page ? 'paginate_button previous active' : 'paginate_button previous';
            var li_url      = this.getPageUrl(li_page);
            var a = createElement('a', { 'attrs': { 'href' : li_url } }, li_page);
            lis.push(createElement('li', { 'class': li_class }, [a]));
        }

        //添加尾页
        if(this.page < this.totalCount){
            var a_next = createElement('a', { 'attrs': { 'href' : this.getPageUrl(this.page + 1) } }, this.nextText);
            lis.push(createElement('li', { 'class': 'paginate_button previous' }, [a_next]));
        }

        //返回列表主元素
        return createElement('li', { 'class': 'pagination' }, lis);
    }
});