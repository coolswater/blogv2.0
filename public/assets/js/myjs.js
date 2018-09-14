//获取url参数
function GetRequest() {
    var url = location.href; //获取url中"?"符后的字串
    var reg = '-?[1-9]\\d*';
    var str = url.match(reg);
    if (str != null) {
        return str[0];
    } else {
        return false;
    }
}

//用户退出
function logout() {
    ajaxReuest('/logout', '', reloadPage)
}

//重载页面
function reloadPage() {
    window.location.reload();
}

//表单验证
$.validator.addMethod("checkName", function (value, element, params) {
    var checkName = /^\w{8,24}$/g
    return this.optional(element) || (checkName.test(value))
}, "6-18位英文、数字或下画线")
$.validator.addMethod("checkPwd", function (value, element, params) {
    var checkName = /^\w{8,24}$/g
    return this.optional(element) || (checkName.test(value))
}, "8-24位英文、数字或下画线")
$.validator.addMethod("checkEmail", function (value, element, params) {
    var checkEmail = /^[a-z0-9]+@([a-z0-9]+\.)+[a-z]{2,4}$/i
    return this.optional(element) || (checkEmail.test(value))
}, "请输入正确的邮箱！")
$.validator.onfocusout = false

//登录表单与验证
$("#loginForm").validate({
    rules: {
        username: {
            required: true,
            checkName: true
        },
        password: {
            required: true,
            checkPwd: true
        },
        verifyCode: {
            required: true,
        },

    },
    messages: {
        username: {
            required: "用户名为空"
        },
        password: {
            required: "密码为空"
        },
        verifyCode: {
            required: "验证码为空"
        }
    },
    submitHandler: function (form) {
        var url = '/login';
        var param = {
            username: $('#username').val(),
            password: $('#password').val(),
            verifyCode: $('#verifyCode').val(),
        };
        ajaxReuest(url, param, modifyLoginStatus);
    },
});

//更新登录状态
function modifyLoginStatus(data) {
    if (data.code == 1) {
        var html = '';
        html += '<li class="nav-item dropdown">';
        html += '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"';
        html += 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        html += '<img src="' + data.data.portrait + '"/>';
        html += '</a>';
        html += '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        html += '<a class="dropdown-item" href="/profile">个人主页</a>';
        html += '<div class="dropdown-divider"></div>';
        html += '<a class="dropdown-item" href="javascript:logout()">用户退出</a>';
        html += '</div>';
        html += '</li>';
        $('.sign-in').html(html);
        $("#login").modal("hide")
    } else {
        $('#loginError').html('*' + data.msg);
        $('#loginError').show();
        $('.codeImage').attr('src', '/getVerifyCode?rand=' + Math.random());
    }
}

//忘记密码表单与验证
$("#forgetForm").validate({
    rules: {
        forgetEmail: {
            required: true,
            checkEmail: true
        },
        verifyCode: {
            required: true,
        },

    },
    messages: {
        forgetEmail: {
            required: "电子邮箱为空",
        },
        verifyCode: {
            required: "验证码为空"
        }
    },
    submitHandler: function (form) {
        var url = '/forgetPwd';
        var param = {
            email: $('#forgetEmail').val(),
            verifyCode: $('#forgetVerifyCode').val(),
        };
        ajaxReuest(url, param, forgetCallback);
    },
});

//忘记密码回调
function forgetCallback(data) {
    if (data.code == 1) {
        //找回成功，隐藏找回页，显示成功页
        $('#forgetPwd').modal('hide');
        var msg = '新密码已发送至您邮箱，3s后跳转登录页！';
        $('#successInfo').html(msg);
        $('#success').modal('show');
        //3s后隐藏成功页，显示登录页
        var t = 3;
        var a = setInterval(function () {
            t--;
            var msg = '新密码已发送至您邮箱，' + t + 's后跳转登录页！';
            $('#successInfo').html(msg);
            if (t == 0) {
                $('#success').modal('hide');
                $('#login').modal('show');
                clearInterval(a);
            }
        }, 1000);
    } else {
        $('#forgetError').html('*' + data.msg);
        $('#forgetError').show();
        $('.codeImage').attr('src', '/getVerifyCode?rand=' + Math.random());
    }
}

//注册表单验证
$("#registerForm").validate({
    rules: {
        regusername: {
            required: true,
            checkName: true
        },
        regpassword: {
            required: true,
            checkPwd: true
        },
        confirm_password: {
            required: true,
            checkPwd: true,
            equalTo: "#regpassword"
        },
        email: {
            required: true,
            checkEmail: true
        },
        regverifyCode: {
            required: true
        }
    },
    messages: {
        regusername: {
            required: "用户名为空"
        },
        regpassword: {
            required: "密码为空"
        },
        confirm_password: {
            required: "确认密码为空",
            equalTo: "两次密码输入不一致"
        },
        email: {
            required: "邮箱为空"
        },
        regverifyCode: {
            required: "验证码为空"
        }
    },
    submitHandler: function (form) {
        var url = '/register';
        var param = {
            username: $('#regusername').val(),
            password: $('#regpassword').val(),
            confirmPassword: $('#confirm_password').val(),
            email: $('#email').val(),
            verifyCode: $('#regverifyCode').val(),
        };
        ajaxReuest(url, param, registerCallback);
    }

});

//注册回调
function registerCallback(data) {
    if (data.code == 1) {
        //注册成功，隐藏注册页，显示成功页
        $('#register').modal('hide')
        var msg = '注册成功，3s后跳转登录页！';
        $('#successInfo').html(msg);
        $('#success').modal('show');
        //3s后隐藏成功页，显示登录页
        var t = 3;
        var a = setInterval(function () {
            t--;
            var msg = '注册成功，' + t + 's后跳转登录页！';
            $('#successInfo').html(msg);
            if (t == 0) {
                $('#success').modal('hide');
                $('#login').modal('show');
                clearInterval(a);
            }
        }, 1000);
    } else {
        $('#registerError').html('*' + data.msg);
        $('#registerError').show();
        $('.codeImage').attr('src', '/getVerifyCode?rand=' + Math.random());
    }
}

//右侧回到顶部
$(document).ready(function () {
    $("#leftsead a").hover(function () {
        if ($(this).prop("className") == "youhui") {
            $(this).children("img.hides").show();
        }
    }, function () {
        if ($(this).prop("className") == "youhui") {
            $(this).children("img.hides").hide('slow');
        } else {
            $(this).children("img.hides").animate({marginRight: '-143px'}, 'slow', function () {
                $(this).hide();
                $(this).next("img.shows").show();
            });
        }
    });
    $("#top_btn").click(function () {
        if (scroll == "off") return;
        $("html,body").animate({scrollTop: 0}, 600);
    });
});

/**
 * 分页插件
 * @param pagination  分页容器
 * @param pageCurrent 当前所在页
 * @param pageCurrent 当前所在页
 * @param pageSum     总页数
 * @param callback    调用ajax
 */
function setPage(pagination, pageCurrent, pageSum, callback) {
    $(pagination).bootstrapPaginator({
        //设置版本号
        bootstrapMajorVersion: 3,
        // 显示第几页
        currentPage: pageCurrent,
        // 总页数
        totalPages: pageSum,
        //当单击操作按钮的时候, 执行该函数, 调用ajax渲染页面
        onPageClicked: function (event, originalEvent, type, page) {
            // 把当前点击的页码赋值给currentPage, 调用ajax,渲染页面
            currentPage = page
            callback && callback()
        }
    })
}

/**
 * ajax封装
 *
 * @param url           请求地址
 * @param params        请求参数
 * @param callback      回调函数
 * @param callbackParam 回调参数
 */
var ajaxReuest = function (url, params, callback, callbackParam) {
    $.ajax({
        url: url,
        type: 'post',
        data: params,
        dataType: 'json',
        success: function (response) {
            callback && callback(response, callbackParam);
        }
    });
}
//分页插件
var setPaginator = function (pagination, pageCurr, pageSum, callback, callbackParam) {
    $(pagination).bootstrapPaginator({
        /*当前使用的是3版本的bootstrap*/
        bootstrapMajorVersion: 3,
        /*配置的字体大小是小号*/
        size: 'small',
        /*当前页*/
        currentPage: pageCurr,
        /*一共多少页*/
        totalPages: pageSum,
        /*页面上最多显示几个含数字的分页按钮*/
        numberOfPages: pageSum,
        /*设置显示的样式，默认是箭头	*/
        itemTexts: function (type, page, current) {
            switch (type) {
                case "first":
                    return "首页";
                case "prev":
                    return "<";
                case "next":
                    return ">";
                case "last":
                    return "末页";
                case "page":
                    return page;
            }
        },
        onPageClicked: function (event, originalEvent, type, page) {
            callback && callback(callbackParam, page);
            $("html,body").animate({scrollTop: 0}, 0);
        }
    });
};

//获取评论列表
function getCommentList(params, page) {
    var url = params.url;
    var param = {
        pageSize: 5,
        pageNo: page,
        param: params.data,
    };

    var callbacks = function (data) {
        var totalPage = data.data.totalPage;
        var pageSize = 5;
        var pageNo = data.data.pageNo;
        var lists = data.data.list;
        var html = '';
        for (i = 0; i < lists.length; i++) {
            html += '<li class="media border-bottom-dashed mt-3">';
            html += '<img class="portrait_small rounded-circle mr-3" src="' + lists[i].portrait + '"';
            html += 'alt="用户头像">';
            html += '<div class="media-body">';
            html += '<p class="create_time mb-1">' + lists[i].create_time + '</p>';
            html += '<p class="mt-0 mb-1">';
            html += '<span class="font-weight-bold">' + lists[i].nickName + ' </span>';
            html += '<span>评论了《' + lists[i].title + '》</span>';
            html += '</p>';
            html += '<p>“' + lists[i].content + '”</p>';
            html += '</div>';
            html += '</li>';
        }
        $('#commentList').html(html);
        if (totalPage > pageNo) {
            setPaginator('#commentPagination', pageNo, Math.ceil(totalPage / pageSize), getCommentList, params);
        }
    };
    //ajax请求
    ajaxReuest(url, param, callbacks);
}

//获取文章列表
var getArtcleList = function (cid, page) {
    var url = '/getArtcleList';
    var param = {
        pageNo: page,
        cid: cid,
        pageSize: 10
    };
    var callbacks = function (data) {
        var totalPage = data.data.totalPage;
        var pageSize = 10;
        var pageNo = data.data.pageNo;
        var lists = data.data.list;
        var category = data.data.category;
        var html = '';
        if (lists.length > 0) {
            for (i = 0; i < lists.length; i++) {
                html += '<li class="media">';
                html += '<a href="' + lists[i].url + '" target="_blank">';
                html += '<img class="mr-3 artcle_thumb rounded" src="' + lists[i].thumb + '" alt="文章缩略图">';
                html += '</a>';
                html += '<div class="media-body">';
                html += '<h5 class="mt-1 mb-3"><a href="' + lists[i].url + '" target="_blank">' + lists[i].title + '</a>';
                html += '</h5>';
                html += '<p class="media-content">' + lists[i].title + '</p>';
                html += '<div class="media-footer">';
                html += '<span class="category">' + lists[i].category + '</span>';
                html += '<span>/</span>';
                html += '<span class="author">' + lists[i].hits + '</span>';
                html += '<span>/</span>';
                html += '<span class="publish_time">' + lists[i].publishTime + '</span>';
                html += '</div>';
                html += '</div>';
                html += '</li>';
            }
        } else {
            html += '<p class="mt-3 ml-4">暂无数据</p>';
        }
        $('#artcleList').html(html);
        $('#listCategory').html(category);
        if (Math.ceil(totalPage / pageSize) > pageNo) {
            setPaginator('#artcleListPagination', pageNo, Math.ceil(totalPage / pageSize), getArtcleList, cid);
        }
    };
    //ajax请求
    ajaxReuest(url, param, callbacks);
};

//获取我的文章列表
function getMyArtcleList(type, page = 1) {
    var url = '/getMyArtcleList';
    var param = {
        pageNo: page,
        type: type,
    };
    var callbacks = function (data) {
        var totalPage = data.data.totalPage;
        var pageSize = 10;
        var pageNo = data.data.pageNo;
        var lists = data.data.list;
        var html = '';
        if (lists.length > 0) {
            for (i = 0; i < lists.length; i++) {
                html += '<li class="media">';
                html += '<div class="media-body">';
                html += '<h6 class="mt-1 mb-3">[' + lists[i].category + ']&nbsp;&nbsp;<a href="' + lists[i].url + '" target="_blank">' + lists[i].title + '</a>';
                html += '</h5>';
                html += '<div class="media-footer">';
                html += '<span class="author">阅读：' + lists[i].hits + '</span>';
                html += '<span class="publish_time">发布：' + lists[i].publishTime + '</span>';
                html += '<a href="#" class="badge badge-primary mr-1">编辑</a>';
                if (lists[i].status == 1) {
                    html += '<a href="javascript:deleteArtcle(' + lists[i].id + ')" class="badge badge-danger mr-1">删除</a>';
                    html += '<a href="#" class="badge badge-info mr-1">下线</a>';
                } else if (lists[i].status == 2) {
                    html += '<a href="javascript:deleteArtcle(' + lists[i].id + ')" class="badge badge-danger mr-1">删除</a>';
                    html += '<a href="#" class="badge badge-success mr-1">发布</a>';
                } else {
                    html += '<a href="#" class="badge badge-danger mr-1">发布</a>';
                }
                html += '</div>';
                html += '</div>';
                html += '<a href="' + lists[i].url + '" target="_blank">';
                html += '<img class="mr-3 artcle_thumb_small rounded" src="' + lists[i].thumb + '" alt="文章缩略图">';
                html += '</a>';
                html += '</li>';
            }
        } else {
            html += '<p class="mt-3 ml-4">暂无数据</p>';
        }
        $('#artcleList').html(html);
        if (Math.ceil(totalPage / pageSize) > pageNo) {
            setPaginator('#artcleListPagination', pageNo, Math.ceil(totalPage / pageSize), callbacks, type);
        }
    };
    //ajax请求
    ajaxReuest(url, param, callbacks);
}

//发表评论
function comment(artcleId) {
    var url = '/comment';
    var param = {
        artcleId: artcleId,
        content: $('#comment').val()
    };
    ajaxReuest(url, param, commentCallback, artcleId);
}

//评论回调
function commentCallback(data, artcleId) {
    if (data.code == 1) {
        $('#comment').html = '';
    } else if (data.code == 10020) {
        $('#login').modal('show');
    } else {
        $('.error').html(data.msg);
        var a = setInterval(function () {
            $('.error').html('');
            getCommentList(artcleId);
            clearInterval(a);
        }, 2000);
    }
}