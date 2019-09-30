Vue.component('lte-sortable', {
    props:{
        'columns':{ type: Array, default: function(){ return [6,6]; }}
    },
    mounted:function(){
        $(".connectedSortable").sortable({
            connectWith: ".connectedSortable",
            handle: ".box-header, .nav-tabs",
            placeholder: "sort-highlight",
            forcePlaceholderSize: true,
            zIndex: 999999
        });
        $(".connectedSortable").find(".box-header, .nav-tabs").css("cursor","move");
    },
    template: `<lte-row>
    <section class="connectedSortable" v-for="(width,key) in columns" :class="'col-lg-'+width">
        <slot :name="'col_'+(key+1)"></slot>
    </section>
</lte-row>`
});