Vue.component('lte-checkbox', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'name': {type:String, default: null},
        'value': {default: null},
        'disabled': {type: Boolean, default: false},
    },
    methods:{
        change:function(e){
            var value = e.target.checked;
            this.$emit('change', value);
        }
    },
    computed: {
        checked: function () {
            if(this.value)
                return true;
            else
                return null;
        }
    },
    template: `<div class="checkbox">
    <label>
        <input type="checkbox" :name="name" :checked="checked" @input="change" :disabled="disabled">
        <slot></slot>
    </label>
</div>`
});