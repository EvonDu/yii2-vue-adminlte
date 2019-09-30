Vue.component('lte-input', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'value': {default: ""},
        'type': {type: String, default: ""},
        'placeholder': {type: String, default: ""},
        'disabled': {type: Boolean, default: false},
    },
    methods:{
        change:function(e){
            var value = e.target.value;
            this.$emit('change', value);
        }
    },
    template: `<input :type="type" class="form-control" :placeholder="placeholder" :disabled="disabled" :value="value" @input="change">`
});