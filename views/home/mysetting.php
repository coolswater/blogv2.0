<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/fileinput.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/summernote-bs4.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="main mt-0 font-85">
    <h6 class="card-header bg-white p-3">基本信息</h6>
    <div class="bg-white p-3">
        <div class="errorInfo"></div>
        <form id="postForm" action="/publishArtcle" enctype="multipart/form-data">
            <!--昵称-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">昵称</span>
                </div>
                <input type="text" class="form-control" id="nick_name" name="nick_name"
                       value="<?= $user['nick_name'] ?>" aria-label="Default"
                       placeholder="昵称：5-10个字"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--手机-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">手机</span>
                </div>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?= $user['mobile'] ?>"
                       aria-label="Default"
                       placeholder="手机号码"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--邮箱-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">邮箱</span>
                </div>
                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>"
                       aria-label="Default"
                       placeholder="电子邮箱：如123@163.com"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--简介-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">简介</span>
                </div>
                <textarea class="form-control" id="profile" name="profile" rows="3" aria-label="With textarea"
                          placeholder="个人简介：150个字" required><?= $user['description'] ?></textarea>
            </div>
            <div class="mt-3">
                <button type="button" onclick="modifyArtcle(2)" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">保存</button>
            </div>
        </form>
    </div>
    <h6 class="card-header bg-white p-3">修改密码</h6>
    <div class="bg-white p-3">
        <div class="errorInfo"></div>
        <form id="postForm2" action="/setPassword" enctype="multipart/form-data">
            <!--原密码-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">原密码</span>
                </div>
                <input type="text" class="form-control" id="oldPassword" name="oldPassword" aria-label="Default"
                       placeholder="原密码：5-10个字"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--新密码-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">新密码</span>
                </div>
                <input type="password" class="form-control" id="newPassword" name="newPassword" aria-label="Default"
                       placeholder="新密码"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--确认密码-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">确认密码</span>
                </div>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                       aria-label="Default"
                       placeholder="确认密码"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>

            <div class="mt-3">
                <button type="button" onclick="modifyArtcle(2)" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">保存</button>
            </div>
        </form>

    </div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/piexif.js"></script>
<script src="/assets/js/sortable.js"></script>
<script src="/assets/js/purify.js"></script>
<script src="/assets/js/fileinput.min.js"></script>
<script src="/assets/js/zh.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/myjs.js"></script>
<script>
    $(document).ready(function () {
        initFileinput();    //初始化图片上传
    })
</script>
</body>
</html>