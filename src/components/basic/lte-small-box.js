Vue.component('lte-small-box', {
    props:{
        'col-lg': {type: Number, default: 3},
        'col-xs': {type: Number, default: 6},
        'bg': {type: String, default: "#00c0ef"},
        'color': {type: String, default: "#ffffff"},
        'title': {type: String, default: "New Tag"},
        'icon': {type: String, default: "ion ion-bag"},
        'btnUrl': {type: String, default: "#"},
        'btnText': {type: String, default: "More info"},
    },
    template: `<div class="small-box" :style="{backgroundColor:bg,color:color}">
            <div class="inner">
                <h3>
                    <slot>0</slot>
                 </h3>
                 <p>{{title}}</p>
            </div>
            <div class="icon">
                <i :class="icon"></i>
            </div>
            <a :href="btnUrl" class="small-box-footer">{{btnText}} <i class="fa fa-arrow-circle-right"></i></a>
        </div>`
});