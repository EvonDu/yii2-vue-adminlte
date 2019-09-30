Vue.component('lte-btn', {
    props:{
        'href': {type: String, default: ""},
        'type': {type: String, default: "primary"},
        'size': {type: String, default: ""},
        'a':{type: Boolean, default: false},
        'app': {type: Boolean, default: false},
        'flat': {type: Boolean, default: false},
        'block': {type: Boolean, default: false},
        'submit': {type: Boolean, default: false},
        'disabled': {type: Boolean, default: false},
        'icon': {type: String, default: null},
    },
    computed: {
        btnClass: function () {
            var boxClass = {};
            boxClass['btn'] = true;
            boxClass['btn-app'] = this.app;
            boxClass['btn-flat'] = this.flat;
            boxClass['btn-block'] = this.block;
            boxClass['disabled'] = this.disabled;
            boxClass['btn-'+ this.type] = true;
            boxClass['btn-'+ this.size] = this.size ? true : false;
            return boxClass;
        }
    },
    methods:{
        click:function(e){
            if(this.href && this.a === false)
                window.location.href = this.href;
            this.$emit('click');
        }
    },
    template: `<a :class="btnClass" @click="click" :href="href" v-if="a"><i :class="icon" v-if="icon"></i><slot></slot></a>
        <button :class="btnClass" @click="click" :type="submit?'submit':'button'" v-else><i :class="icon" v-if="icon"></i><slot></slot></button>`
});