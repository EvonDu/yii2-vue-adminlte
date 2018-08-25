Vue.component('summernote', {
    model: { prop: 'value', event: 'change'},
    props: {
        'value': {type:String, default: ""},
        'height': {type:Number, default: 300},
    },
    data:function(){
        return {
            "id":Math.random()*9999,
        }
    },
    mounted:function(){
        //获取this
        var _this = this;
        //初始化
        $('div[summernote_id="'+this.id+'"]').summernote({ height:this.height});
        //初始值
        $('div[summernote_id="'+this.id+'"]').code(this.value);
        //挂载事件
        $('div[summernote_id="'+this.id+'"]').on('summernote.change',function(){
            var value = $(this).code();
            _this.$emit('change', value);
        });
    },
    template: `<div :summernote_id="id"></div>`
});