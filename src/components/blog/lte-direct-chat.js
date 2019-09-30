Vue.component('lte-direct-chat', {
    props:{
        'type':{type: String, default: "success"},
        'openContacts':{type: Boolean, default: false},
        'items':{type: Array, default: function(){
            return [
                {img:"http://adminlte.la998.com/dist/img/user4-128x128.jpg",name:"Mike Doe",time:"23 Jan 14:00 pm",content:"Is this template really for free? That's unbelievable!"},
                {img:"http://adminlte.la998.com/dist/img/user3-128x128.jpg",name:"Alexander Pierce",time:"23 Jan 14:23 pm",content:"You better believe it!",right:true},
                {img:"http://adminlte.la998.com/dist/img/user4-128x128.jpg",name:"Mike Doe",time:"23 Jan 15:37 pm ",content:"Working with AdminLTE on a great new app! Wanna join?"},
                {img:"http://adminlte.la998.com/dist/img/user3-128x128.jpg",name:"Alexander Pierce",time:"23 Jan 16:10 pm ",content:"I would love to.",right:true},
            ];
        }},
        'contacts':{type: Array, default: function(){
            return [
                {img:"http://adminlte.la998.com/dist/img/user4-128x128.jpg",name:"Mike Doe",date:"2/28/2015",content:"How have you been? I was..."},
            ];
        }}
    },
    computed: {
        chatClass: function () {
            var chatClass = {};
            chatClass['direct-chat'] = true;
            chatClass['direct-chat-' + this.type] = this.type ? true : false;
            chatClass['direct-chat-contacts-open'] = this.openContacts;
            return chatClass;
        },
    },
    template: `<div :class="chatClass" style="position: relative;overflow: hidden">
    <div class="direct-chat-messages">
        <div class="direct-chat-msg" v-for="(item,key) in items" :key="key" :class="{right:item.right}">
            <div class="direct-chat-info clearfix">
                <span class="direct-chat-name" :class="{'pull-left':!item.right,'pull-right':item.right}">{{item.name}}</span>
                <span class="direct-chat-timestamp" :class="{'pull-left':item.right,'pull-right':!item.right}">{{item.time}}</span>
            </div>
            <img class="direct-chat-img" :src="item.img">
            <div class="direct-chat-text">{{item.content}}</div>
        </div>
    </div>
    <div class="direct-chat-contacts">
        <ul class="contacts-list">
            <li v-for="(item,key) in contacts" :key="key">
                <a href="#">
                    <img class="contacts-list-img" :src="item.img" alt="User Image">
                    <div class="contacts-list-info">
                        <span class="contacts-list-name">
                            {{item.name}}
                            <small class="contacts-list-date pull-right">{{item.date}}</small>
                        </span>
                        <span class="contacts-list-msg">{{item.content}}</span>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>`
});