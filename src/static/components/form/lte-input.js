Vue.component('lte-input', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'value': {default: ""},
        'type': {type: String, default: ""},
        'placeholder': {type: String, default: ""},
    },
    methods:{
        change:function(e){
            var value = e.target.value;
            this.$emit('change', value);
        }
    },
    template: `<input :type="type" class="form-control" :placeholder="placeholder" :value="value" @input="change">`
});