//表单验证
// $.validator.addMethod("checkName", function (value, element, params) {
//     var checkName = /^\w{6,18}$/g
//     return this.optional(element) || (checkName.test(value))
// }, "6-18位英文、数字或下画线")
// $.validator.addMethod("checkPwd", function (value, element, params) {
//     var checkName = /^\w{8,24}$/g
//     return this.optional(element) || (checkName.test(value))
// }, "8-24位英文、数字或下画线")
// $.validator.addMethod("checkEmail", function (value, element, params) {
//     var checkEmail = /^[a-z0-9]+@([a-z0-9]+\.)+[a-z]{2,4}$/i
//     return this.optional(element) || (checkEmail.test(value))
// }, "请输入正确的邮箱！")
//
// $.validator.onfocusout = false

//登录表单与验证
// $("#loginForm").validate({
//     rules: {
//         username: {
//             required: true,
//             checkName: true
//         },
//         password: {
//             required: true,
//             checkPwd: true
//         }
//     },
//     submitHandler: function (form) {
//         alert("登录事件!")
//         // form.submit()
//     },
//     messages: {
//         username: {
//             required: "用户名不能为空"
//         },
//         password: {
//             required: "密码不能为空"
//         }
//     }
// })
// //注册表单验证
// $("#registerForm").validate({
//     rules: {
//         regusername: {
//             required: true,
//             checkName: true
//         },
//         regpassword: {
//             required: true,
//             checkPwd: true
//         },
//         confirm_password: {
//             required: true,
//             checkPwd: true,
//             equalTo: "#regpassword"
//         },
//         email: {
//             required: true,
//             checkEmail: true
//         }
//     },
//     messages: {
//         regusername: {
//             required: "用户名不能为空"
//         },
//         regpassword: {
//             required: "密码不能为空"
//         },
//         confirm_password: {
//             required: "确认密码不能为空",
//             equalTo: "两次密码输入不一致"
//         },
//         email: {
//             required: "用户名不能为空"
//         }
//     },
//     submitHandler: function (form) {
//         alert("注册事件!")
//         // form.submit()
//     }
//
// })
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

function DataBinder(object_id) {
    // Use a jQuery object as simple PubSub
    var pubSub = jQuery({});

    // We expect a `data` element specifying the binding
    // in the form:data-bind-<object_id>="<property_name>"
    var data_attr = "bind-" + object_id,
        message = object_id + ":change";

    // Listen to chagne events on elements with data-binding attribute and proxy
    // then to the PubSub, so that the change is "broadcasted" to all connected objects
    jQuery(document).on("change", "[data-]" + data_attr + "]", function (eve) {
        var $input = jQuery(this);

        pubSub.trigger(message, [$input.data(data_attr), $input.val()]);
    });

    // PubSub propagates chagnes to all bound elemetns,setting value of
    // input tags or HTML content of other tags
    pubSub.on(message, function (evt, prop_name, new_val) {
        jQuery("[data-" + data_attr + "=" + prop_name + "]").each(function () {
            var $bound = jQuery(this);

            if ($bound.is("")) {
                $bound.val(new_val);
            } else {
                $bound.html(new_val);
            }
        });
    });
    return pubSub;
}

/**
 * 分页插件
 * @param pagination  分页容器
 * @param pageCurrent 当前所在页
 * @param pageCurrent 当前所在页
 * @param pageSum 总页数
 * @param callback 调用ajax
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

//ajax封装
var ajaxReuest = function (url, params, callback) {
    $.ajax({
        url: url,
        type: 'post',
        data: params,
        dataType: 'json',
        success: function (response) {
            callback && callback(response);
        }
    });
}
//分页插件
var setPaginator = function (pageCurr, pageSum, callback, callbackParam) {
    $('#commentPagination').bootstrapPaginator({
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
                    return "上一页";
                case "next":
                    return "下一页";
                case "last":
                    return "末页";
                case "page":
                    return page;
            }
        },
        onPageClicked: function (event, originalEvent, type, page) {
            currPage = page; // 注意currPage的作用域
            callback && callback(callbackParam);
        }
    });
};

var currPage = 1;

//获取评论列表

function getCommentList(artcleId) {
    var url = '/getCommentList';
    var param = {
        pageSize: 5,
        pageNo: currPage,
        artcleId: artcleId
    };
    var callbacks = function (data) {
        var totalPage = data.data.totalPage;
        var pageSize = 5;
        var pageNo = data.data.pageNo;
        var lists = data.data.list;
        var html = '';
        for (i = 0; i < lists.length; i++) {
            html += '<li class="media pt-3 pb-3">';
            html += '<img class="portrait rounded-circle mr-3" src="' + lists[i].portrait + '" alt="用户头像">';
            html += '<div class="media-body">';
            html += '<span class="font-weight-bold">' + lists[i].nickName + '</span>';
            html += '<span class="ml-3">' + lists[i].create_time + '</span>';
            html += '<p class="mt-2">' + lists[i].content + '</p>';
            html += '<p class="comment_nav">';
            html += '<span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>';
            html += '<span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>';
            html += '</p>';
            html += '</div>';
            html += '</li>';
        }
        $('#commentList').html(html);

        setPaginator(pageNo, Math.ceil(totalPage / pageSize), getCommentList, artcleId);
    };
    //ajax请求
    ajaxReuest(url, param, callbacks);
}

//获取文章列表
var getArtcleList = function () {
    var url = '/getArtcleList';
    var param = {
        pageNo: currPage,
        artcleId: 1,
        pageSize: 10
    };
    var callback = function (data) {
        var totalPage = data.data.totalPage;
        var pageSize = 5;
        var pageNo = data.data.pageNo;
        $("tbody").html('dfadf');
        setPaginator(pageNo, Math.ceil(totalPage / pageSize), getCommentList);
    };
    //ajax请求
    ajaxReuest(url, param, callback);
};
