<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bootstrap4</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/summernote.css" rel="stylesheet">
    <link href="/assets/css/fileinput.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="main mt-0">
    <h6 class="mb-2 bg-white p-3 border-bottom-0 font-weight-bold">发表文章</h6>
    <div class="bg-white p-3">
        <form>
            <div class="form-group mb-4">
                <input type="title" class="form-control pl-3" id="title" placeholder="标题">
            </div>
            <div class="form-group">
                <textarea class="form-control pl-3" id="summary" rows="3" placeholder="摘要"></textarea>
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
            <div id="summernote"></div>
            <div class="form-group mt-3">
                <input id="thumb" name="thumb[]" type="file" multiple>
            </div>
            <button type="submit" class="btn btn-danger mt-5">发表</button>
        </form>
    </div>
</div>
<script src="/assets/js/jquery.slim.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/summernote.js"></script>

<script src="/assets/js/piexif.js"></script>
<script src="/assets/js/sortable.js"></script>
<script src="/assets/js/purify.js"></script>
<script src="/assets/js/fileinput.min.js"></script>
<script src="/assets/js/zh.js"></script>
<script>
    //在线编辑器
    $('#summernote').summernote({
        lang: 'zh-CN',
        placeholder: '内容',
        height: 300,                 //编辑器高度
        disableDragAndDrop: true,    //禁止拖放,
        focus: true,
        airMode: false,
        shortcuts: true,
    });
    //图片上传
    $('#thumb').fileinput({
        language: 'zh', //设置语言
        uploadUrl: "/uploadFiles.do", //上传的地址
        allowedFileExtensions: ['jpg', 'gif', 'png'],//接收的文件后缀
        //uploadExtraData:{"id": 1, "fileName":'123.mp3'},
        uploadAsync: true, //默认异步上传
        showUpload: true, //是否显示上传按钮
        showPreview: true, //是否显示预览
        showClose: false,//是否显示标题
        browseClass: "btn btn-danger", //按钮样式
        dropZoneEnabled: true,//是否显示拖拽区域
        maxFileSize: 2048,//单位为kb，如果为0表示不限制文件大小
        minFileCount: 1,
        maxFileCount: 1, //表示允许同时上传的最大文件个数
        enctype: 'multipart/form-data',
        validateInitialCount: true,
    }).on("fileuploaded", function (event, data, previewId, index) {

    });
</script>
</body>
</html>