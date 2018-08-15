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
    height: 300,                 //编辑器高度
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
                url: '请求后台地址',
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