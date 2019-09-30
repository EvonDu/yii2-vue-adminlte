Vue.component('lte-col', {
    props:{
        'col': {"default": "12"},
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