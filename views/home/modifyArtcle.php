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
    <h6 class="mb-2 bg-white p-3 border-bottom-0 font-weight-bold">编辑文章</h6>
    <div class="bg-white p-3">
        <div class="errorInfo"></div>
        <form id="postForm" action="/modifyArtcle" enctype="multipart/form-data">
            <!--文章栏目-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">栏目</label>
                </div>
                <select class="custom-select" id="category" name="category">
                    <?php foreach ($categoryList as $cate): ?>
                        <option <?php if ($artcle['cid'] === $cate['id']) echo "selected"; ?>
                                value="<?= $cate['id'] ?>"><?= $cate['category'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!--文章标题-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">标题</span>
                </div>
                <input type="text" class="form-control" id="title" name="title" value="<?= $artcle['title'] ?>"
                       aria-label="Default"
                       placeholder="标题：8-50个字"
                       aria-describedby="inputGroup-sizing-default" required>
            </div>
            <!--文章摘要-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">摘要</span>
                </div>
                <textarea class="form-control" id="summary" name="summary" rows="2" aria-label="With textarea"
                          placeholder="摘要：150个字" required><?= $artcle['summary'] ?></textarea>
            </div>
            <!--文章类别-->
            <div class="input-group mb-3">
                <div class="input-group-prepend mr-2">
                    <span class="input-group-text" id="inputGroup-sizing-default">类别</span>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type"
                           value="0" <?php if ((int)$artcle['type'] === 0) echo "checked"; ?> id="inlineRadio1">
                    <label class="form-check-label" for="inlineRadio1">默认</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type"
                           value="1" <?php if ((int)$artcle['type'] === 1) echo "checked"; ?> id="inlineRadio2">
                    <label class="form-check-label" for="inlineRadio2">精选</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type"
                           value="2" <?php if ((int)$artcle['type'] === 2) echo "checked"; ?> id="inlineRadio3">
                    <label class="form-check-label" for="inlineRadio3">专题</label>
                </div>
            </div>
            <!--缩率图-->
            <div class="input-group mb-3">
                <input type="file" class="custom-file-input" name="thumb" id="thumb" multiple>
                <input type="hidden" name="thumbs" id="thumbs" value="<?= $artcle['thumb'] ?>"/>
            </div>
            <!--文章内容-->
            <textarea type="text" name="summernote" id="summernote" required></textarea>

            <div class="mt-3">
                <input type="hidden" name="id" id="id" value="<?= $artcle['id'] ?>"/>
                <button type="button" onclick="modifyArtcle(2)" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">保存</button>
                <button type="button" onclick="modifyArtcle(1)" class="btn btn-danger mt-2 mb-5 pl-5 pr-5">发表</button>
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
    $(document).ready(function () {
        initSummernote();   //初始化在线编辑器
        initFileinput("<?= $artcle['thumb'] ?>");    //初始化图片上传
        $('#summernote').summernote('code', '<?= $artcle['content']?>');
    })
</script>
</body>
</html>
