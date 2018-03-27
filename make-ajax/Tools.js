//创建XHR
function $ajax(ajaxObj) {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch ( e ) {
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch ( e ) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    var url = '';
    var type = 'GET'; //GET
    var data = null;
    if (ajaxObj.data) {
        data = ajaxObj.data
    }
    xmlHttp.onreadystatechange = ajaxObj.success;
    xmlHttp.open(type, url, true);
    //xmlHttp.send();
    xmlHttp.open("POST", url, true)
    xmlHttp.setRequestHeader("Content-type", "application/json");
    var sendstr = JSON.stringify(data);
    xmlHttp.send(sendstr);
//var success=()=>
//return xmlHttp;
}
if (xmlHttpauto.readyState == 4 || xmlHttpauto.readyState == "complete") {
    if ((xmlHttpauto.status >= 200 && xmlHttpauto.status < 300) || xmlHttpauto.status == 304) {
        var json = JSON.parse(xmlHttpauto.responseText);
        //alert(json.username); 
        if (typeof (json.id) != "undefined" & json.id.trim() != "") {
            window.location.href = '/index.html';
        }

    } else {
        //alert("请求失败");
    }
    //if(xmlHttp.responseText=="登录成功"){

    //}

}
// var ss = {
//     a: 'a',
//     b: 'b'
// }
// console.log();

















//读取cookies 
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