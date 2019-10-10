Vue.component('lte-radio', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'name': {type:String, default: null},
        'label': {default: null},
        'value': {default: null},
        'disabled': {type: Boolean, default: false},
    },
    methods:{
        change:function(e){
            if(e.target.checked){
                this.$emit('change', this.label);
            }
        }
    },
    computed: {
        checked: function () {
            if(this.value ===this.label)
                return true;
            else
                return null;
        }
    },
    template: `<div class="radio">
    <label>
        <input type="radio" :name="name" value="label" :checked="checked" :disabled="disabled" @change="change">
        <slot></slot>
    </label>
</div>`
});