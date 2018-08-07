Vue.component('bootstrap-switch', {
    model: { prop: 'value', event: 'change'},
    props: {
        //成员属性
        'name': {type:String, default: null},
        'size': {type:String, default: "small"},
        'onText': {type:String, default: "ON"},
        'offText': {type:String, default: "OFF"},
        'onColor': {type:String, default: "success"},
        'offColor': {type:String, default: "danger"},
        //数据元素
        'value': {default: false},
        'trueValue': {default: true},
        'falseValue': {default: false},
        'trueFormValue': {default: 1},
        'falseFormValue': {default: 0},
    },
    data:function(){
        return {
            "checked":false,
            "switch_id":(((1+Math.random())*0x10000)|0).toString(16).substring(1)
        }
    },
    computed: {
        formValue: function () {
            return this.checked ? this.trueFormValue : this.falseFormValue;
        },
        booleanValue: function () {
            return this.checked ? this.trueValue : this.falseValue;
        },
    },
    created:function(){
        this.checked = (this.value == this.trueValue || this.value === true);
    },
    mounted:function(){
        var _this = this;
        $("[switch_id='"+this.switch_id+"']").bootstrapSwitch({
            onText : this.onText,
            offText : this.offText,
            onColor : this.onColor,
            offColor : this.offColor,
            size : this.size,})
            .on('switchChange.bootstrapSwitch', function (e, data) {
                _this.checked = data;
                _this.$emit('change', _this.booleanValue);
            });
        if(this.checked) $("[switch_id='"+this.switch_id+"']").bootstrapSwitch('state',true);
    },
    template: `<span>
        <input type="checkbox" :switch_id="switch_id"/>
        <input type="hidden" :value="formValue" :name="name"/>
    </span>`
});