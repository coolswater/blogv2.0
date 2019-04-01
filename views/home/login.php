<!-- 登录窗口 start -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="loginLabel">用户登录</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="loginError" class="error mt-3" style="display: none"></p>
                <form class="form-group" id="loginForm">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback icon"></span>
                        <input class="form-control" name="username" id="username" placeholder="用户名/邮箱"
                               type="text" placeholder="text">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock form-control-feedback icon"></span>
                        <input class="form-control" name="password" id="password" placeholder="登录密码"
                               type="password"
                               placeholder="text">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-barcode form-control-feedback icon"></span>
                        <input class="form-control w-50" name="verifyCode" id="verifyCode" maxlength="4"
                               placeholder="验证码"
                               type="text"
                               placeholder="text">
                        <img class="codeImage float-right" src="/getVerifyCode" title="点我，换一张"
                             onclick="javascript:this.src='/getVerifyCode?rand='+Math.random()">
                    </div>
                    <div class="text-left">
                        <button class="btn btn-danger w-100 mt-4" type="submit">登 录</button>
                        <div class="mt-2 mb-5 button">

                        </div>
                    </div>
                    <div class="quick_login">
                        <span>快捷登录：</span>
                        <a href="https://api.weibo.com/oauth2/authorize?client_id=103340070&response_type=code&redirect_uri=https://www.hexiaodong.com/snsCallback?s=weibo"><img src="/assets/images/weibo.png" /></a>
                        <img src="/assets/images/weixin.png" />
                        <img src="/assets/images/qq.png" />
                        <img src="/assets/images/github2.png" />
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!-- 登录窗口 end -->