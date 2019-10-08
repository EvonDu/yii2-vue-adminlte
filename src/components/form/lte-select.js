Vue.component('lte-select', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'name': {type:String, default: null},
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
    template: `<select class="form-control" :name="name" :value="value" @input="change" :disabled="disabled">
    <option v-for="(value,key) in items" :value="key" :key="key">{{value}}</option>
</select>`
});