Vue.component('lte-panel', {
    props:{
        'type': {type: String, default: "default"},
    },
    computed: {
        panelClass: function () {
            var panelClass = {};
            panelClass['panel-'+ this.type] = this.type ? true : false;
            return panelClass;
        },
        existHeader: function() {
            if(this.$slots.header)
                return true;
            else
                return false;
        },
        existFooter: function () {
            if(this.$slots.footer)
                return true;
            else
                return false;
        },
    },
    template: `<div class="panel" :class="panelClass">
    <div class="panel-heading" v-if="existHeader">
        <slot name="header"></slot>
    </div>
    <div class="panel-body">
        <slot></slot>
    </div>
    <div class="panel-footer" v-if="existFooter">
        <slot name="footer"></slot>
    </div>
</div>`
});