Vue.component('lte-fast-panel', {
    props:{
        'title': {type: String, default: ""},
        'type': {type: String, default: "default"},
    },
    computed: {
        panelClass: function () {
            var panelClass = {};
            panelClass['panel-'+ this.type] = this.type ? true : false;
            return panelClass;
        },
        existHeader: function() {
            if(this.title != "" || this.$slots.header)
                return true;
            else
                return false;
        },
    },
    template: `<div class="panel" :class="panelClass" style="margin-bottom: 0;border: none">
    <div class="panel-heading" style="padding: 15px;padding-bottom: 0;background: #e8edf0;border-color: #e8edf0;position: relative" v-if="existHeader">
        <div class="panel-lead" style="margin-bottom: 15px">
            <em style="display: block;font-weight: bold;font-style: normal">{{title}}</em>
            <slot name="header"></slot>
        </div>
    </div>
    <div class="panel-body">
        <slot></slot>
    </div>
</div>`
});