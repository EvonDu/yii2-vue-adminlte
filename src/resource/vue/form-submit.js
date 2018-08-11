function formSubmit(){
    //成员属性
    var method = 'post';
    var action = '';
    var formName = '';
    var csrfEnable = true;
    var csrfParam = '_csrf-backend';
    var csrfToken = '';
    this.setMethod = function(value){
        method = value;
    };
    this.setAction = function(value){
        action = value;
    };
    this.setFormName = function(value){
        formName = value;
    };
    this.setCsrfEnable = function(value){
        csrfEnable = value ? true : false;
    };
    this.setCsrfParam = function(value){
        csrfParam = value;
    };
    this.setCsrfParam = function(value){
        csrfParam = value;
    };
    this.setCsrfToken = function(value){
        csrfToken = value;
    };
    //接口方法
    this.submit = function(data){
        //创建表单元素
        var form = document.createElement("form");
        for(var key in data){
            var value = data[key];
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = formName ? formName+"["+key+"]" : key;
            input.value = value;
            form.appendChild(input);
        }

        //添加csrfToken
        if(csrfEnable){
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = csrfParam;
            input.value = csrfToken;
            form.appendChild(input);
        }

        //设置选项
        form.method = method;
        if(action)
            form.action = action;

        //提交表单
        document.body.appendChild(form);
        form.submit();
    };
}