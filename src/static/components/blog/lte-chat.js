Vue.component('lte-chat', {
    props:{
        'items':{type: Array, default: function(){
            return [
                {img:"http://adminlte.la998.com/dist/img/user3-128x128.jpg","state":"online",name:"Susan Doe",time:"14:23",content:"用户发来了一条留言信息，请注意查看与回复。",url:"#",attachment:""},
                {img:"http://adminlte.la998.com/dist/img/user4-128x128.jpg","state":"online",name:"Alexander Pierce",time:"14:51",content:"用户发来了一条留言信息，请注意查看与回复。",url:"#",attachment:""},
                {img:"http://adminlte.la998.com/dist/img/user5-128x128.jpg","state":"offline",name:"Mike Doe",time:"15:06",content:"用户发来了一条留言信息，请注意查看与回复。",url:"#",attachment:""},
                {img:"http://adminlte.la998.com/dist/img/user6-128x128.jpg","state":"online",name:"Sarah",time:"14:15",content:"用户发来了一条留言信息，请注意查看与回复。",url:"#",attachment:""},
            ];
        }}
    },
    template: `<div class="chat">
            <div class="item" v-for="(item,key) in items" :key="key">
                <img :src="item.img" alt="user image" :class="item.state">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{item.time}}</small>
                        {{item.name}}
                    </a>
                    {{item.content}}
                </p>
                <div class="attachment" v-if="item.attachment">{{item.attachment}}</div>
            </div>
        </div>`
});