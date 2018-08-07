Vue.component('lte-footer', {
    props:{
        'version': {type: String, default: "0.1.0"},
    },
    template: `<footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> {{version}} </div>
        <slot></slot>
    </footer>`
});