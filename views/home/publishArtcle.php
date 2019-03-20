<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/fileinput.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="main mt-0 font-85">
    <h6 class="mb-2 bg-white p-3 border-bottom-0 font-weight-bold">发表文章</h6>
    <div class="bg-white p-3">
        <div class="errorInfo"></div>
        <form id="postForm" action="/publishArtcle" enctype="multipart/form-data">
            <!--文章栏目-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">栏目</label>
                </div>
                <select class="custom-select" id="category" name="category">
                    <option selected>==========请选择文章栏目==========</option>
                    <?php foreach ($categoryList as $cate): ?>
                        <option value="<?= $cate['id'] ?>"><?= $cate['category'] ?></option>
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
            <div style="text-align:left;">
                <div id="content"><p>欢迎使用<b>wangEditor 富文本编辑器</b>，请输入内容...</p></div>
            </div><!--demo end-->

            <div class="mt-3">
                <button type="button" onclick="modifyArtcle(2)" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">保存</button>
                <button type="button" onclick="modifyArtcle(1)" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">发表</button>
            </div>
        </form>
    </div>
</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/fileinput.min.js"></script>
<script src="/assets/js/piexif.js"></script>
<script src="/assets/js/zh.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/wangEditor.js"></script>
<script src="/assets/js/myjs.js"></script>
<script>
    //初始化在线编辑器
    var E = window.wangEditor
    var editor = new E('#content')
    editor.customConfig.uploadImgShowBase64 = true
    // 配置服务器端地址
    editor.customConfig.uploadFileName = 'thumb'
    editor.customConfig.uploadImgMaxSize = 1024 * 1024
    editor.customConfig.uploadImgServer = '/uploadThumb'
    // 自定义配置颜色（字体颜色、背景色）
    editor.customConfig.colors = [
        '#000000',
        '#eeece0',
        '#1c487f',
        '#4d80bf',
        '#c24f4a',
        '#8baa4a',
        '#46acc8',
        '#f9963b',
        '#ffd400',
        '#fcaf17',
        '#ffffff',
        '#f47920',
        '#f15b6c',
        '#1d953f',
        '#225a1f',
        '#ed1941',
        '#2a5caa',
        '#102b6a',
        '#8552a1',
        '#0000FF',
    ]
    editor.customConfig.uploadImgHooks = {
        // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
        // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
        customInsert: function (insertImg, result, editor) {
            // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
            // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

            // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
            var url = result.data
            insertImg(url)
        }
    }
    editor.create()
    
    $(document).ready(function () {
        initFileinput();    //初始化图片上传
    })

    //发布文章
    function modifyArtcle(status) {
        $("#postForm").validate({
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
                content: {
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
                content: {
                    required: "*内容不能为空"
                }
            },
        });
        if ($('#postForm').valid()) {
            var _data = {
                status: status,
                id: $('#id').val(),
                title: $('#title').val(),
                thumb: $('#thumbs').val(),
                summary: $('#summary').val(),
                category: $('#category').val(),
                type: $("input[name='type']:checked").val(),
                content: editor.txt.html(),
            };
            $.ajax({
                url: $("#postForm").attr('action'),
                type: 'post',
                data: _data,
                dataType: 'json',
                success: function (data) {
                    window.location.replace('/myArtcles');
                }
            })

        } else {
            return false;
        }
    }
</script>
</body>
</html>