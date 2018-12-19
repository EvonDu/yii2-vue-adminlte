Vue.component('lte-sidebar-setting', {
    template: `<div>
        <aside class="control-sidebar control-sidebar-dark">
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <slot name="home"></slot>
                </div>
                <div class="tab-pane" id="control-sidebar-stats-tab">
                    Stats Tab Content
                </div>
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <slot name="setting"></slot>
                </div>
            </div>
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>`
});