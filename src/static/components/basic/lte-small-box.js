Vue.component('lte-small-box', {
    props:{
        'col-lg': {type: Number, default: 3},
        'col-xs': {type: Number, default: 6},
        'bg': {type: String, default: "aqua"},
        'title': {type: String, default: "New Orders"},
        'icon': {type: String, default: "ion ion-bag"},
        'btnUrl': {type: String, default: "#"},
        'btnText': {type: String, default: "More info"},
    },
    template: `<div class="small-box" :class="'bg-'+bg">
            <div class="inner">
                <h3><slot></slot></h3>
                 <p>{{title}}</p>
            </div>
            <div class="icon">
                <i :class="icon"></i>
            </div>
            <a :href="btnUrl" class="small-box-footer">{{btnText}} <i class="fa fa-arrow-circle-right"></i></a>
        </div>`
});