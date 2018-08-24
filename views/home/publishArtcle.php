<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/summernote-bs4.css" rel="stylesheet">
    <link href="/assets/css/fileinput.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="main mt-0 font-85">
    <h6 class="mb-2 bg-white p-3 border-bottom-0 font-weight-bold">发表文章</h6>
    <div class="bg-white p-3">
        <form id="publishArtcle" enctype="multipart/form-data">
            <div class="form-group mb-4">
                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                <input type="title" class="form-control pl-3" id="title" placeholder="标题：8-50个字">
            </div>
            <div class="form-group">
                <textarea class="form-control pl-3" id="summary" rows="2" placeholder="摘要：150个字"></textarea>
            </div>
            <div class="form-group mt-3 mb-3">
                <span>类别：</span>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="type" value="0" id="inlineRadio1">
                    <label class="form-check-label" for="inlineRadio1">默认</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="1" id="inlineRadio2">
                    <label class="form-check-label" for="inlineRadio2">精选</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" value="2" id="inlineRadio3">
                    <label class="form-check-label" for="inlineRadio3">专题</label>
                </div>
            </div>
            <div class="form-group mt-3 mb-3">
                <input id="thumb" name="thumb[]" type="file" multiple>
            </div>
            <div id="summernote"></div>
            <div class="mt-3">
                <button type="submit" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">保存</button>
                <button type="submit" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">发表</button>
            </div>
        </form>
    </div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/summernote-bs4.js"></script>
<script src="/assets/js/summernote-zh-CN.js"></script>

<script src="/assets/js/piexif.js"></script>
<script src="/assets/js/sortable.js"></script>
<script src="/assets/js/purify.js"></script>
<script src="/assets/js/fileinput.min.js"></script>
<script src="/assets/js/zh.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/homeJs.js"></script>
<script src="/assets/js/myjs.js"></script>
<script>
    //注册表单验证
    $("#publishArtcle").validate({
        rules: {
            title: {
                required: true,
            },
            summary: {
                required: true,
                checkPwd: true
            },
            thumb: {
                required: true
            },
            summernote: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "标题不能为空"
            },
            summary: {
                required: "摘要不能为空"
            },
            thumb: {
                required: "缩率图不能为空"
            },
            summernote: {
                required: "内容不能为空"
            }
        },
        submitHandler: function (form) {
            var url = '/publishArtcle';
            var param = {
                title: $('#title').val(),
                summary: $('#summary').val(),
                thumb: $('#thumb').val(),
                content: $('#summernote').val()
            };
            ajaxReuest(url, param, publishCallback);
        }
    });

    function publishCallback(data) {
        console.log(data)
    }
</script>
</body>
</html>