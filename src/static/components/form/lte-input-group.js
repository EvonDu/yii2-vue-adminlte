Vue.component('lte-input-group', {
    computed: {
        existBeforeAddon: function() {
            console.log(this.$slots)
            if(this.$slots["before-addon"])
                return true;
            else
                return false;
        },
        existAfterAddon: function () {
            if(this.$slots["after-addon"])
                return true;
            else
                return false;
        },
        existBeforeBtn: function() {
            console.log(this.$slots)
            if(this.$slots["before-btn"])
                return true;
            else
                return false;
        },
        existAfterBtn: function () {
            if(this.$slots["after-btn"])
                return true;
            else
                return false;
        },
    },
    template: `<div class="input-group">
    <span class="input-group-addon" v-if="existBeforeAddon">
        <slot name="before-addon"></slot>
    </span>
    <span class="input-group-btn" v-if="existBeforeBtn">
        <slot name="before-btn"></slot>
    </span>
    <slot></slot>
    <span class="input-group-addon" v-if="existAfterAddon">
        <slot name="after-addon"></slot>
    </span>
    <span class="input-group-btn" v-if="existAfterBtn">
        <slot name="after-btn"></slot>
    </span>
</div>`
});