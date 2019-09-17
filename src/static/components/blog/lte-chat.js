Vue.component('lte-chat', {
    props:{
        'items':{type: Array, "default": function(){
            return [
                {img:"http://adminlte.la998.com/dist/img/user4-128x128.jpg","state":"online",name:"Mike Doe",time:"14:15",content:"我想见你来讨论一下最新消息新主题的到来。 他们说这将是一个市场上最好的主题",url:"#",attachment:""},
                {img:"http://adminlte.la998.com/dist/img/user3-128x128.jpg","state":"offline",name:"Alexander Pierce",time:"14:23",content:"我想见你来讨论一下最新消息新主题的到来。 他们说这将是一个市场上最好的主题",url:"#",attachment:""},
            ];
        }},
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