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
            //获取name和value
            var value = data[key];
            var name = formName ? formName+"["+key+"]" : key;
            //过滤null
            if(value === null)
                continue;
            //特殊处理数组和对象
            if(typeof value == 'object'){
                //特殊处理数组和对象
                var hash = getArrayHash(name,value);
                for(var i in hash){
                    var input = document.createElement("input");
                    input.type = "hidden";
                    input.name = hash[i].name;
                    input.value = hash[i].value;
                    form.appendChild(input);
                }
            }
            //其他普通处理
            else{
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = name;
                input.value = value;
                form.appendChild(input);
            }
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

    //辅助方法
    function getArrayHash(name,array){
        var hash = [];
        console.log(typeof array);
        console.log(array);
        var isArray = !isNaN(array.length);
        if(typeof array == 'object'){
            for(var key in array){
                var value = array[key];
                if(typeof value == 'object'){
                    if(isArray)
                        hash = getArrayHash(name+"["+key+"]",value);
                    else
                        hash = getArrayHash(name+"['"+key+"']",value);
                }
                else{
                    var item = {};
                    if(isArray)
                        item.name = name+"[]";
                    else
                        item.name = name+"["+key+"]";
                    item.value = value;
                    hash.push(item);
                }
            }
        }
        return hash;
    }
}