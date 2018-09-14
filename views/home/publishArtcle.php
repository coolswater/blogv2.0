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
        <div class="errorInfo"></div>
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
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--文章摘要-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">摘要</span>
                </div>
                <textarea class="form-control" id="summary" name="summary" rows="2" aria-label="With textarea"
                          placeholder="摘要：150个字" required></textarea>
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
            <!--缩率图-->
            <div class="input-group mb-3">
                <input type="file" class="custom-file-input" name="thumb" id="thumb" multiple>
                <input type="hidden" name="thumbs" id="thumbs"/>
            </div>
            <!--文章内容-->
            <textarea type="text" name="summernote" id="summernote" required></textarea>

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
<script src="/assets/js/myjs.js"></script>
<script>
    //在线编辑器
    $('#summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']], //字体大小
            ['font', ['bold', 'underline', 'clear']],
            ['height', ['height']], //行高
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']]
        ],
        lang: 'zh-CN',
        placeholder: '内容',
        height: 250,                 //编辑器高度
        disableDragAndDrop: true,    //禁止拖放,
        focus: true,
        airMode: false,
        shortcuts: true,
        callbacks: {
            onImageUpload: function (file) {  //图片默认以二进制的形式存储到数据库，调用此方法将请求后台将图片存储到服务器，返回图片请求地址到前端
                //将图片放入Formdate对象中
                var formData = new FormData();
                //‘picture’为后台获取的文件名，file[0]是要上传的文件
                formData.append("thumb", file[0]);
                $.ajax({
                    type: 'post',
                    url: '/uploadThumb',
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json', //请求成功后，后台返回图片访问地址字符串，故此以text格式获取，而不是json格式
                    success: function (picture) {
                        $('#summernote').summernote('insertImage', picture.data);
                    },
                    error: function () {
                        alert("上传失败");
                    }
                });
            }
        }
    });
    //图片上传
    $('#thumb').fileinput({
        language: 'zh',                             //设置语言
        uploadUrl: "/uploadThumb",                  //上传的地址
        // deleteUrl: "/deleteThumb",               //删除图片地址
        allowedFileExtensions: ['jpg', 'png'],      //接收的文件后缀
        uploadAsync: true,                          //默认异步上传
        showUpload: true,                           //是否显示上传按钮
        showCaption: false,                         //是否显示被选文件的简介
        showBrowse: true,                           //是否显示浏览按钮
        showPreview: true,                          //是否显示预览
        showClose: false,                           //是否显示标题
        browseClass: "btn btn-danger",              //按钮样式
        dropZoneEnabled: true,                      //是否显示拖拽区域
        maxFileSize: 1024,                          //单位为kb，如果为0表示不限制文件大小
        minFileCount: 1,
        maxFileCount: 1,                            //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount: true,
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
    }).on("fileuploaded", function (event, data, previewId, index) {
        if (data.response.code == 1) {
            $('#thumbs').val(data.response.data);
        }
    });
    //提交表单验证
    $("#publishArtcle").validate({
        ignore: '',
        errorLabelContainer: '.errorInfo',
        wrapper: 'li',
        rules: {
            category: {
                required: true
            },
            title: {
                required: true,
            },
            summary: {
                required: true,
                rangelength: [5, 150]
            },
            thumbs: {
                required: true
            },
            summernote: {
                required: true,
            },
        },
        messages: {
            title: {
                required: "*标题不能为空!"
            },
            summary: {
                required: "*摘要不能为空"
            },
            thumbs: {
                required: '*请上传缩略图'
            },
            summernote: {
                required: "*内容不能为空"
            }
        },
        submitHandler: function (form) {
            var _data = {
                category: $('#category').val(),
                title: $('#title').val(),
                summary: $('#summary').val(),
                type: $("input[name='type']:checked").val(),
                thumb: $('#thumbs').val(),
                content: $("#summernote").summernote("code"),
            };
            $.ajax({
                url: '/publishArtcle',
                type: 'post',
                data: _data,
                dataType: 'json',
                success: function (data) {
                    window.location.replace('/myArtcles');
                }
            })
        }
    });

    function publishCallback(data) {
        console.log(data)
    }
</script>
</body>
</html>