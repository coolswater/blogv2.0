<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/summernote-bs4.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="main mt-0 font-85">
    <h6 class="mb-2 bg-white p-3 border-bottom-0 font-weight-bold">发表文章</h6>
    <div class="bg-white p-3">
        <form id="publishArtcle" enctype="multipart/form-data">
            <!--文章栏目-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">栏目</label>
                </div>
                <select class="custom-select" id="category" name="category">
                    <option selected>==========请选择文章栏目==========</option>
                    <?php foreach ($categoryList as $cate): ?>
                        <option value="<?= $cate['cid'] ?>"><?= $cate['category'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!--文章标题-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">标题</span>
                </div>
                <input type="text" class="form-control" id="title" name="title" aria-label="Default"
                       placeholder="标题：8-50个字"
                       aria-describedby="inputGroup-sizing-default">
            </div>
            <!--文章摘要-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">摘要</span>
                </div>
                <textarea class="form-control" id="summary" name="summary" rows="3" aria-label="With textarea"
                          placeholder="摘要：150个字"></textarea>
            </div>
            <!--文章类别-->
            <div class="input-group mb-3">
                <div class="input-group-prepend mr-2">
                    <span class="input-group-text" id="inputGroup-sizing-default">类别</span>
                </div>
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
            <!--文章缩率图-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">缩率图</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="thumb" id="thumb">
                    <label class="custom-file-label" for="thumb">Choose file</label>
                </div>
            </div>
            <!--文章内容-->
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
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/homeJs.js"></script>
<script src="/assets/js/myjs.js"></script>
<script>
    //选中文件后事件
    // $('#thumb').change(function () {
    //     $(".thumbImg").attr("src", URL.createObjectURL($(this)[0].files[0]));
    // })

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
            $(form)._ajaxSubmit();
        }
    });

    function publishCallback(data) {
        console.log(data)
    }
</script>
</body>
</html>