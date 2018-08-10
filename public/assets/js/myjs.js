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


//ajax请求
function ajaxRequest(url, data) {
    $.ajax({
        url: url,
        data: data,
        dataType: 'json',
        success: function (data) {
            return data.data;
        },
        error: function () {
            $('.alert').alert();
        }
    })
}

