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
    height: 280,                 //编辑器高度
    disableDragAndDrop: true,    //禁止拖放,
    focus: true,
    airMode: false,
    shortcuts: true,
    callbacks: {
        onImageUpload: function (file) {  //图片默认以二进制的形式存储到数据库，调用此方法将请求后台将图片存储到服务器，返回图片请求地址到前端
            //将图片放入Formdate对象中
            var formData = new FormData();
            //‘picture’为后台获取的文件名，file[0]是要上传的文件
            formData.append("picture", file[0]);
            $.ajax({
                type: 'post',
                url: '/',
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'text', //请求成功后，后台返回图片访问地址字符串，故此以text格式获取，而不是json格式
                success: function (picture) {
                    $('#summernote').summernote('insertImage', picture);
                },
                error: function () {
                    alert("上传失败");
                }
            });
        }
    }
});