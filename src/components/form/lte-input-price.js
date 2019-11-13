Vue.component('lte-input-price', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'value': {default: ""},
        'placeholder': {type: String, default: ""},
        'disabled': {type: Boolean, default: false}
    },
    data:function(){
        return {
            temp:0
        }
    },
    created:function(){
        this.temp = this.value/100;
    },
    methods:{
        change:function(value){
            var temp = value;
            temp = temp.replace(/[^(\d|\.)]/g, "");
            temp = temp.replace(/^\./g, "");
            temp = temp.replace(/\.{2,}/g, ".");
            temp = temp.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
            temp = temp.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
            this.temp = temp;
        },
        blur:function (e) {
            console.log(this.temp);
            e.target.value = this.temp;
            this.$emit('change', this.temp * 100);
        }
    },
    render: function(createElement){
        return createElement(
            'lte-input',
            {
                'props': {
                    "value": this.temp,
                    "placeholder" : this.placeholder,
                    "disabled" : this.disabled,
                    "type" : "text"
                },
                'on': {
                    change: this.change,
                    blur: this.blur
                }
            }
        );
    }
});