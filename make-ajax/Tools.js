//创建XHR
function ajax(ajaxObj) {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}
//获取cookie
function GetCookie(name) {
    var arr,
        reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) return unescape(arr[2]);
    else return null;
}
//删除cookies
function DelCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() + (-1 * 24 * 60 * 60 * 1000));
    var cval = getCookie(name);
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}

//验证权限
function verification() {
    var http = ajax();
    //请求发送后的回调
    http.onreadystatechange = onVerification;
    //假如这个是后端验证接口
    var url = 'http://localhost:8080/verification';
    //获取cookie,cookie可以由后端直接设置
    var token = GetCookie("Token");
    http.open("GET", url, true);

    http.setRequestHeader("Content-type", "application/json");
    //将token加在header里面
    http.setRequestHeader("Authorization", 'bearer ' + token);
    http.send();
}
//验证请求发出后的回调
function onVerification(xmlHttp) {
    //请求发送完成，并接收到后台返回的信息
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        if ((xmlHttp.status >= 200 && xmlHttp.status < 300) || xmlHttp.status == 304) {
            alert("验证成功")
        } else {
            alert("验证失败");
        }
        //后端返回的信息
        console.log(xmlHttp.responseText);
    }
}
verification()
// var ss = {
//     a: 'a',
//     b: 'b'
// }
// console.log();
//读取cookies 

// regist();
// function onregist(xmlHttp) {
//     if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
//         if ((xmlHttp.status >= 200 && xmlHttp.status < 300) || xmlHttp.status == 304) {
//             alert("验证成功")
//         } else {
//             alert("验证失败");
//         }
//         //if(xmlHttp.responseText=="登录成功"){

//         //}

//     }
// }
// function regist() {
//     var http = ajax();
//     //请求发送后的回调
//     http.onreadystatechange = onregist;
//     var url = 'http://localhost:8080/regist';
//     var data = {
//         username: 'wang',
//         password: 'wang'
//     }
//     //获取cookie,cookie可以由后端直接设置
//     var token = GetCookie("Token");
//     http.open("POST", url, true);

//     http.setRequestHeader("Content-type", "application/json");
//     http.send(JSON.stringify(data));
// }


















/*实现类似jq的ajax*/

// s
// $.ajax({
//     url: '/login.php',
//     type: 'GET', //GET
//     async: true, //或false,是否异步
//     timeout: 5000, //超时时间
//     dataType: 'json', //返回的数据格式：json/xml/html/script/jsonp/text
//     beforeSend: function(xhr) {
//         //console.log(xhr)
//         //console.log('发送前')
//     },
//     success: function(data, textStatus, jqXHR) {
//         //console.log(data)
//         //console.log(textStatus)
//         //console.log(jqXHR)
//         var json = JSON.parse(jqXHR.responseText);
//         //alert(json.username); 
//         if (typeof (json.id) != "undefined" & json.id.trim() != "") {
//             var headpic = document.getElementById("headpic");
//             headpic.setAttribute("src", "/img/" + json.username + ".jpg");
//             var piclink = document.getElementById("headlink");
//             piclink.setAttribute("href", "/login");
//             var addlink = document.getElementById("newartical");
//             addlink.setAttribute("href", "/add");
//         }
//     },
//     error: function(xhr, textStatus) {
//         console.log('错误')
//         console.log(xhr)
//         console.log(textStatus)
//     },
//     complete: function() {
//         console.log('结束')
//     }
// })