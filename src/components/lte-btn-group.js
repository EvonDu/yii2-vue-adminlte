Vue.component('lte-btn-group', {
    props:{
        'vertical': {type: Boolean, default: false},
    },
    computed: {
        groupClass: function () {
            var boxClass = {};
            boxClass['btn-group'] = !this.vertical;
            boxClass['btn-group-vertical'] = this.vertical;
            return boxClass;
        }
    },
    template: `<div :class="groupClass"><slot></slot></div>`
});