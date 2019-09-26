Vue.component('lte-form-group', {
    props:{
        'label': {type: String, default: ""},
        'error': {type: String, default: ""},
        'form': {type: String, default: ""},
        'feedback': {type: String, default: ""},
    },
    template: `<div class="form-group" :class="{'has-error':error,'has-feedback':feedback}">
    <label :for="form" v-if="label">{{label}}</label>
    <slot></slot>
    <span class="form-control-feedback" :class="feedback"></span>
    <p class="help-block help-block-error" v-if="error">{{error}}</p>
</div>`
});