Vue.component('lte-input', {
    model: {
        prop: 'value', event: 'change'
    },
    props:{
        'value': {default: ""},
        'label': {type: String, default: ""},
        'error': {type: String, default: ""},
        'type': {type: String, default: ""},
        'form': {type: String, default: ""},
        'feedback': {type: String, default: ""},
        'placeholder': {type: String, default: ""},
    },
    methods:{
        change:function(e){
            var value = e.target.value;
            this.$emit('change', value);
        }
    },
    template: `<div class="form-group" :class="{'has-error':error,'has-feedback':feedback}">
    <label :for="form" v-if="label">{{label}}</label>
    <input :type="type" class="form-control" :placeholder="placeholder" :value="value" @input="change">
    <span class="form-control-feedback" :class="feedback"></span>
    <p class="help-block help-block-error" v-if="error">{{error}}</p>
</div>`
});