Vue.component('lte-box', {
    props:{
        'icon':{type: String, default: ""},
        'title': {type: String, default: ""},
        'type': {type: String, default: "primary"},
        'solid': {type: Boolean, default: false},
        'collapse': {type: Boolean, default: true},
        'tooltip': {type: Boolean, default: false},
        'remove': {type: Boolean, default: false},
        'noPadding': {type: Boolean, default: false},
    },
    computed: {
        boxClass: function () {
            var boxClass = {};
            boxClass['box'] = true;
            boxClass['box-solid'] = this.solid;
            boxClass['box-'+ this.type] = this.type ? true : false;
            return boxClass;
        },
        existFooter: function () {
            if(this.$slots.footer)
                return true;
            else
                return false;
        },
    },
    template: `<div :class="boxClass">
        <div class="box-header with-border">
            <h3 class="box-title"><i :class="icon" v-if="icon"></i> {{title}}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="tooltip" v-if="tooltip"><i class="fa fa-circle-o"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="collapse" v-if="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" v-if="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body" :class="{'no-padding':noPadding}">
            <slot></slot>
        </div>
        <div class="box-footer" v-if="existFooter">
            <slot name="footer"></slot>
        </div>
    </div>`
});