<!-- 注册窗口 start -->
<div id="register" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registerLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="registerLabel">用户注册</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="registerError" class="error mt-3" style="display: none"></p>
                <form class="form-group" id="registerForm">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback icon"></span>
                        <input class="form-control" id="regusername" name="regusername" type="text"
                               placeholder="用户名：8-24位字母或数字">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock form-control-feedback icon"></span>
                        <input class="form-control" id="regpassword" name="regpassword" type="password"
                               placeholder="密码：8-24位字母或数字">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock form-control-feedback icon"></span>
                        <input class="form-control" id="confirm_password" name="confirm_password"
                               type="password"
                               placeholder="确认密码：8-24位字母或数字">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-envelope form-control-feedback icon"></span>
                        <input class="form-control" id="email" name="email" type="text"
                               placeholder="邮箱：例如:123@123.com">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-barcode form-control-feedback icon"></span>
                        <input class="form-control w-50" name="regverifyCode" id="regverifyCode" maxlength="4"
                               placeholder="验证码"
                               type="text"
                               placeholder="text">
                        <img class="codeImage float-right" src="/getVerifyCode" title="点我，换一张"
                             onclick="javascript:this.src='/getVerifyCode?rand='+Math.random()">
                    </div>
                    <div class="text-left">
                        <button class="btn btn-danger w-100 mt-4" type="submit">注 册</button>
                        <div class="mt-2 button" data-toggle="modal" data-dismiss="modal" data-target="#login">
                            已有账号？<span class="text-primary">去登录</span>
                        </div>
                        <!--                            <span class="float-left" data-toggle="modal" data-dismiss="modal" data-target="#forgetPwd">-->
                        <!--                                忘记密码?</span>-->
                        <!--                            <span class="float-right" data-toggle="modal" data-dismiss="modal" data-target="#register">-->
                        <!--                                没有账号?-->
                        <!--                                <span class="text-primary">去注册</span>-->
                        <!--                            </span>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 注册窗口 end -->