function templateload() {
    auto();
    loadcomments();
    var articalid = $("head").attr("articalid");
    $("head").data("articalid", articalid);
    //alert($("head").data("articalid"));
}
//自动登录
function auto() {
    //可以用GET,也可以用POST
    $.ajax({
        url: '/login.php',
        type: 'GET', //GET
        async: true, //或false,是否异步
        timeout: 5000, //超时时间
        dataType: 'json', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            //console.log(xhr)
            //console.log('发送前')
        },
        success: function(data, textStatus, jqXHR) {
            //console.log(data)
            //console.log(textStatus)
            //console.log(jqXHR)
            var json = JSON.parse(jqXHR.responseText);
            //alert(json.username); 
            if (typeof(json.id) != "undefined" & json.id.trim() != "") {
                var headpic = document.getElementById("headpic");
                headpic.setAttribute("src", "/img/" + json.username + ".jpg");
                var piclink = document.getElementById("headlink");
                piclink.setAttribute("href", "/login");
                var addlink = document.getElementById("newartical");
                addlink.setAttribute("href", "/add");
            }
        },
        error: function(xhr, textStatus) {
            console.log('错误')
            console.log(xhr)
            console.log(textStatus)
        },
        complete: function() {
            console.log('结束')
        }
    })
}
//自动登录
function auto2() {
    //可以用GET,也可以用POST
    $.ajax({
        url: '/login.php',
        type: 'GET', //GET
        async: true, //或false,是否异步
        timeout: 5000, //超时时间
        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            //console.log(xhr)
            //console.log('发送前')
        },
        success: function(data, textStatus, jqXHR) {
            var json = JSON.parse(jqXHR.responseText);
            //alert(json.status); 
            if (typeof(json.status) != "undefined") {
                if (json.status == "400") {
                    return;
                } else if (json.status == "301") {
                    window.location.href = '/login';
                }
            }
        },
        error: function(xhr, textStatus) {
            window.location.href = '/login';
        },
        complete: function() {
            console.log('结束')
        }
    })
}
//自动登录
function auto3() {
    //可以用GET,也可以用POST
    $.ajax({
        url: '/login.php',
        type: 'GET', //GET
        async: true, //或false,是否异步
        timeout: 5000, //超时时间
        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            //console.log(xhr)
            //console.log('发送前')
        },
        success: function(data, textStatus, jqXHR) {
            var json = JSON.parse(jqXHR.responseText);
            //alert(json.status); 
            if (typeof(json.status) != "undefined") {
                if (json.status == "400") {
                    return;
                }
            }
        },
        error: function(xhr, textStatus) {},
        complete: function() {
            console.log('结束')
        }
    })
}
//加载文章
function loadartical() {
    $.ajax({
        url: '/fetchartical.php',
        type: 'GET', //GET
        async: true, //或false,是否异步
        timeout: 5000, //超时时间
        dataType: 'json', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            //console.log(xhr)
            //console.log('发送前')
        },
        success: function(data, textStatus, jqXHR) {
            //console.log(data)
            //console.log(textStatus)
            //console.log(jqXHR)
            var json = JSON.parse(jqXHR.responseText);
            //alert(json.username); 
            var i = 0;
            //插入文章
            var artical_container = document.getElementById("artical-container");
            while (typeof(json.id[i]) != "undefined") {
                //alert(json.id[i]);
                artical_container.innerHTML = artical_container.innerHTML + "<div class=\"artical\"><a href=\"/p/" + json.id[i] + ".html\"><h1>" + json.title[i] + "</h1></a><h2>" + json.contents[i] + "</h2><h4>" + "Posted by" + " " + json.author[i] + " on " + json.dates[i] + "</h4><div class=\"artical-line\"></div></div>";
                i++;
            }
        },
        error: function(xhr, textStatus) {
            console.log('错误')
            console.log(xhr)
            console.log(textStatus)
        },
        complete: function() {
            console.log('结束')
        }
    })
}
//隐藏大于3的子评论
function hidecomment() {
    console.log("1");
    var elem = document.getElementsByClassName("comment_2");
    if (elem.length > 0) {
        console.log("2");
        for (var i = 0; i < elem.length; i++) {
            var elem_child = document.getElementsByClassName("comment_2")[i].getElementsByTagName("li");
            if (elem_child.length > 3) {
                for (var j = 3; j < elem_child.length - 1; j++) {
                    elem_child[j].setAttribute("style", "display:none");
                    //alert(elem_child[j].getAttribute("style"));
                    console.log("3");
                }
            }
        }
    }
}

function show_comment(obj) {
    if (obj.innerText == "展开") {
        var elem_child = obj.parentNode.parentNode.getElementsByTagName("li");
        if (elem_child.length > 3) {
            for (var j = 3; j < elem_child.length - 1; j++) {
                elem_child[j].setAttribute("style", "display:block");
            }
        }
        obj.innerText = "收起";
    } else {
        var elem_child = obj.parentNode.parentNode.getElementsByTagName("li");
        if (elem_child.length > 3) {
            for (var j = 3; j < elem_child.length - 1; j++) {
                elem_child[j].setAttribute("style", "display:none");
            }
        }
        obj.innerText = "展开";
    }
}

function show_newcomment(obj, mode) {
    if (mode == 1) {
        var par = $(obj).parent().parent();
        var parid = $(obj).parent().parent().data("parent-id");
        var newcomment = $('#newcomment-' + parid);
        if (newcomment.attr("style") == "display:none") {
            newcomment.attr("style", "display:block");
        } else if (newcomment.attr("style") == "display:block") {
            newcomment.attr("style", "display:none");
        }
    } else {
        var par = $(obj).parent().parent();
        var parid = $(obj).parent().parent().data("comment-id");
        var newcomment = $('#newcomment-' + parid);
        var att = par.children("ul").attr("style");
        var haschild = par.children("ul").children("li");
        //alert(haschild.length);
        if (newcomment.attr("style") == "display:none") {
            newcomment.attr("style", "display:block");
        } else if (newcomment.attr("style") == "display:block") {
            newcomment.attr("style", "display:none");
        }
        //alert(att);
        if (att == "display:none") {
            par.children("ul").attr("style", "display:block");
        }
        if ((att == "display:block") & (haschild.length) < 2) {
            par.children("ul").attr("style", "display:none");
        }
        
    }
}
//退出登录
function signout() {
    DelCookie("PHPSESSID");
    DelCookie("username");
    DelCookie("user_id");
    //alert(getCookie("username"));
    location.reload();
}
//删除cookies
function DelCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() + (-1 * 24 * 60 * 60 * 1000));
    var cval = getCookie(name);
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}
//读取cookies 
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg)) return unescape(arr[2]);
    else return null;
}

function newcomment(obj) {
    var articalid = $('head').data("articalid");
    var contents = obj.parentNode.getElementsByTagName("textarea")[0].value;
    //alert(comment);
    if (typeof(content) == "undefined" || content.trim() == "") {
        alert("不能为空");
        return;
    }
    $.ajax({
        url: '/newcomment.php',
        type: 'POST', //GET
        async: true, //或false,是否异步
        data: {
            articalid: articalid,
            content: content,
            parent_id: "null",
        },
        timeout: 5000, //超时时间
        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            console.log(xhr)
            console.log('发送前')
        },
        success: function(data, textStatus, jqXHR) {
            alert(jqXHR.responseText);
            loadcomments();
        },
        error: function(xhr, textStatus) {
            console.log('错误')
            console.log(xhr)
            console.log(textStatus)
        },
        complete: function() {
            console.log('结束')
        }
    })
}
//加载评论
function loadcomments() {
    $.ajax({
        url: '/loadcomments.php',
        type: 'GET', //GET
        async: true, //或false,是否异步
        data: {
            articalid: $("head").data("articalid")
        },
        timeout: 5000, //超时时间
        dataType: 'json', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            //console.log(xhr)
            //console.log('发送前')
        },
        success: function(data, textStatus, jqXHR) {
            //console.log(data)
            //console.log(textStatus)
            //console.log(jqXHR.responseText);
            var json = JSON.parse(jqXHR.responseText);
            var i = 0;
            //加载评论之前先清空
            $("#comments").innerHTML = "";
            while (typeof(json.comments[i]) != "undefined") {
                var comment = json.comments[i];
                //alert(comment.id);
                var id = comment.id;
                var username = comment.username;
                var floor = comment.floor;
                var dates = comment.dates;
                var content = comment.content;
                var children_count = comment.children_count;
                //if (childfloor == 0) {
                var html = '<div class="comment_1" id="comment-' + id + '"><div class="authorbar" style="width: 300px;"><a href="" class="head-a"><img src="/img/root.jpg"></a><div style="display: inline-block;"><span>' + username + '</span><br><span style="width: 300px;height: 60px;font-size: 0.9em;color: #868686">' + floor + '楼 · ' + dates + '</span></div></div><span class="comment">' + content + '</span><div><a class="btn_reply" onclick="show_newcomment(this,2)"><img src="/img/reply2.svg"><span>回复</span></a></div><ul class="comment_2" style="display:none" id="parent-' + id + '"><li><a class="btn_reply2" onclick="show_newcomment(this,1)"><img src="/img/pencil.svg"><span>添加新评论</span></a><span class="btn_showcomment" onclick="show_comment(this)">展开</span></li><div class="newcomment-container" id="newcomment-' + id + '" style="display:none"><textarea class="comment-input" placeholder="写下你的评论..."></textarea><button class="btn_sentcomment" id="send-' + id + '" onclick="newcomment(this)">发送</button></div></ul><div class="line"></div></div>'
                //插入节点
                $("#comments").append(html);
                //利用jquery的data函数引式存储数据
                $('#comment-' + id).data("comment-id", id);
                $('#parent-' + id).data("parent-id", id);
                $('#newcomment-' + id).data("newcomment-id", id);
                $('#send-' + id).data("send-id", id);
                //alert($('#comment-'+id).data("id"));
                var children = comment.children;
                if (children_count > 0) {
                    var j = 0;
                    while (typeof(children[j]) != "undefined") {
                        var child = children[j];
                        var html = '<li id="child-' + child.id + '"><a href="">' + child.username + '</a>: <span class="comment">' + child.content + '</span><div><span>' + child.dates + '</span><a href="" class="btn_reply2" show_newcomment(this,1)><img src="/img/reply2.svg"><span>回复</span></a></div></li>';
                        //插入节点
                        //var partenttnode2 = $('#comment-'+id).getElementsByClassName("comment_2")[0];
                        //当有二级评论时，显示
                        //partenttnode2.setAttribute("style", "display:block")
                        var newNode = document.createElement("div");
                        newNode.innerHTML = html;
                        var childid = '#parent-' + id;
                        var elem_child = $("#childid.li");
                        var len = elem_child.length;
                        $(html).insertBefore(childid + " li:last");
                        $(childid).attr("style", "display:block");
                        j++;
                    }
                }
                i++;
            }
            //hidecomment();
        },
        error: function(xhr, textStatus) {
            console.log('错误')
            console.log(xhr.responseText)
            console.log(textStatus)
        },
        complete: function() {
            console.log('结束')
        }
    })
}
//上传文章
function ArticalUpload(artical, html, title) {
    $.ajax({
        url: '/newartical.php',
        type: 'POST', //GET
        async: true, //或false,是否异步
        data: {
            title: title,
            author: getCookie("username"),
            con: artical,
            html: html
        },
        timeout: 5000, //超时时间
        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {
            console.log('转码')
            //对html进行url转码，来防止&引起的错误
            html = encodeURIComponent(html);
        },
        success: function(data, textStatus, jqXHR) {
            alert(jqXHR.responseText);
            window.location.href = '/index.html';
        },
        error: function(xhr, textStatus) {
            console.log('错误')
            console.log(xhr)
            console.log(textStatus)
        },
        complete: function() {
            console.log('结束')
        }
    })
}

function Login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (typeof(username) == "undefined" || username.trim() == "") {
        alert("请填写完整");
        return;
    }
    if (typeof(password) == "undefined" || password.trim() == "") {
        alert("请填写完整");
        return;
    }
    //写入a字段
    //storage["a"]=1;
    //写入b字段
    /*var storage=window.localStorage;
    storage.username=username;
    storage.password=password;
    //写入c字段
    //storage.setItem("c",3);
    console.log(username);
    console.log(password);
    */
    $.ajax({
        url: '/login.php',
        type: 'POST', //GET
        async: true, //或false,是否异步
        data: {
            username: username,
            password: password
        },
        timeout: 5000, //超时时间
        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {},
        success: function(data, textStatus, jqXHR) {
            var json = JSON.parse(jqXHR.responseText);
            alert(json.msg);
            if (json.status == 200) window.location.href = '/index.html';
        },
        error: function(xhr, textStatus) {},
        complete: function() {}
    })
}

function Register() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if (typeof(username) == "undefined" || username.trim() == "") {
        alert("请填写完整");
        return;
    }
    if (typeof(password) == "undefined" || password.trim() == "") {
        alert("请填写完整");
        return;
    }
    xmlHttp = GetXmlHttpObject()
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request")
        return;
    }
    $.ajax({
        url: '/login.php',
        type: 'POST', //GET
        async: true, //或false,是否异步
        data: {
            username: username,
            password: password
        },
        timeout: 5000, //超时时间
        dataType: 'text', //返回的数据格式：json/xml/html/script/jsonp/text
        beforeSend: function(xhr) {},
        success: function(data, textStatus, jqXHR) {
            alert(xmlHttp.responseText);
            window.location.href = '/login.html';
        },
        error: function(xhr, textStatus) {},
        complete: function() {}
    })
}