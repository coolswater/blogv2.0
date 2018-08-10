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
                <form class="form-group" id="loginForm">
                    <div class="form-group">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <input class="form-control" name="username" id="username" placeholder="用户名/邮箱"
                               type="text" placeholder="text">
                    </div>
                    <div class="form-group">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <input class="form-control" name="password" id="password" placeholder="登录密码"
                               type="password"
                               placeholder="text">
                    </div>
                    <div class="text-left">
                        <button class="btn btn-danger w-100 mt-4" type="submit">登录</button>
                        <div class="mt-2 button" data-toggle="modal" data-dismiss="modal" data-target="#register">
                            没有账号？<span class="text-primary">去注册<span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 登录窗口 end -->