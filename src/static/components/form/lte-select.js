Vue.component('lte-select', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'value': {default: ""},
        'disabled': {type: Boolean, default: false},
        'items': {type: Object, default: function(){ return {} }},
    },
    methods:{
        change:function(e){
            var value = e.target.value;
            this.$emit('change', value);
        }
    },
    template: `<select class="form-control" :disabled="disabled" :value="value" @input="change">
    <option v-for="(value,key) in items" :value="key" :key="key">{{value}}</option>
</select>`
});