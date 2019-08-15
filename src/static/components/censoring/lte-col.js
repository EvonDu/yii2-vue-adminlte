Vue.component('lte-col', {
    props:{
        'col': {type: String, default: "12"},
    },
    computed: {
        colClass: function () {
            return "col-md-" + this.col;
        },
    },
    template: `<div :class="colClass">
        <slot></slot>
    </div>`
})