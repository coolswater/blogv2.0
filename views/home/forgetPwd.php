<!-- 忘记密码 start -->
<div class="modal fade" id="forgetPwd" tabindex="-1" role="dialog" aria-labelledby="forgetPwdLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="forgetPwdLabel">忘记密码</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="forgetError" class="error mt-3" style="display: none"></p>
                <form class="form-group" id="forgetForm">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <input class="form-control" name="forgetEmail" id="forgetEmail" placeholder="注册邮箱"
                               type="text" placeholder="text">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                        <input class="form-control w-50" name="forgetVerifyCode" id="forgetVerifyCode" maxlength="4"
                               placeholder="验证码"
                               type="text"
                               placeholder="text">
                        <img class="codeImage float-right" src="/getVerifyCode" title="点我，换一张"
                             onclick="javascript:this.src='/getVerifyCode?rand='+Math.random()">
                    </div>
                    <div class="text-left">
                        <button class="btn btn-danger w-100 mt-4" type="submit">发送邮件</button>
                        <div class="mt-2 mb-5 button">
                            <span class="float-left" data-toggle="modal" data-dismiss="modal" data-target="#login">
                                有账户?<span class="text-primary">去登录</span>
                            </span>
                            <span class="float-right" data-toggle="modal" data-dismiss="modal" data-target="#register">
                                没有账号?<span class="text-primary">去注册</span>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 忘记密码 end -->