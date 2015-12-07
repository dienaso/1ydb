// 如果可以替换就成

(function() {
    function getCookie(objName){//获取指定名称的cookie的值 
        var arrStr = document.cookie.split("; "); 
        for(var i = 0;i < arrStr.length;i ++){ 
            var temp = arrStr[i].split("="); 
            if(temp[0] == objName) return unescape(temp[1]); 
        }
    }
    var headElem = document.getElementsByTagName('head')[0];
    var bodyElem = document.getElementsByTagName('body')[0];
    var parentElem = headElem||bodyElem;
    var jsonp = function(conf) {
        var callback_name = "bdyt_loader"+new Date/1;  
        //赋值全局函数作为回调函数 
        window[callback_name] = conf.callback;
        var script = document.createElement('script');
        script.src = conf.url+"?callback="+callback_name;
        //发送请求
        parentElem.appendChild(script);
    }
    var quirksMode = (document.documentMode) ? (document.documentMode == 5) : (document.compatMode == "BackCompat");
    if (window.ActiveXObject) {//如果是ie浏览器
        var ua = navigator.userAgent.toLowerCase();
        var ie=ua.match(/msie ([\d.]+)/)[1];
        ie = Math.floor(ie);
    }
    var console=window.console||{log:function(){return;}};
    if(quirksMode && ie <= 6) {//是quirk模式,或者ie版本低于ie6
        console.log(navigator.appVersion);
        return;
    }
    else{//不是quirk模式，才出我们的模块
        var entrance =function(configLink,requireLink){
            var newScriptElem = document.createElement('script');
            newScriptElem.setAttribute('defer','defer');
            newScriptElem.setAttribute('data-main', configLink + '?t=' + Math.ceil(new Date()/3600000) );
            newScriptElem.src = requireLink + '?t=' + Math.ceil(new Date()/3600000);
            parentElem.appendChild(newScriptElem);
        }
        //判断是否有yuntu_test 这个cookie
        bdytTestCookie = getCookie('yuntu_test');
        // 不让ie6浏览器报错
        if(bdytTestCookie === '1')
        {
            jsonp({
                url:'http://cq01-2011q4-rptest3-12.vm.baidu.com:8887/yuntu/getsid',
                callback:function(data){
                    console.log(data);
                    configLink = 'http://cq01-2012h1-rptest12.vm.baidu.com:8887/static/yuntu-dist/'+data+'/js/config.js';
                    requireLink = 'http://cq01-2012h1-rptest12.vm.baidu.com:8887/static/yuntu-dist/'+data+'/js/libs/require.js';
                    entrance(configLink,requireLink);
                }
            })
        }
        else
        {
            jsonp({
                url:'http://tuijian.yuntu.baidu.com/yuntu/getsid',
                callback:function(data){
                    console.log(data);
                    configLink = 'http://static.yuntu.baidu.com/'+data+'/js/config.js';
                    requireLink = 'http://static.yuntu.baidu.com/'+data+'/js/libs/require.js';
                    entrance(configLink,requireLink);
                }
            })
        }
    }
})();
