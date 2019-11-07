Vue.component('lte-input', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'name': {type:String, default: null},
        'value': {default: ""},
        'type': {type: String, default: ""},
        'placeholder': {type: String, default: ""},
        'disabled': {type: Boolean, default: false},
    },
    methods:{
        change:function(e){
            var value = e.target.value;
            this.$emit('change', value);
        },
        blur:function (e) {
            this.$emit('blur', e);
        }
    },
    template: `<input :type="type" class="form-control" :name="name" :value="value" :placeholder="placeholder" :disabled="disabled" @input="change" @blur="blur">`
});