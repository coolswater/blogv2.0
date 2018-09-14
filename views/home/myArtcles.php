<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/icon.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="mt-0">
    <ul class="nav nav-tabs bg-white pt-3 pl-3" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" data-target="1" role="tab"
               aria-controls="home"
               aria-selected="true">已发布</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#" data-target="2" role="tab"
               aria-controls="profile"
               aria-selected="false">待发布</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#" data-target="3" role="tab"
               aria-controls="contact"
               aria-selected="false">已删除</a>
        </li>
    </ul>
    <div>
        <div class="tab-content p-3 bg-white artcle_list" id="artcleList"></div>
        <!--分页-->
        <nav aria-label="Page navigation example">
            <ul id="artcleListPagination" class="pagination"></ul>
        </nav>
    </div>

</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/bootstrap-paginator.js"></script>
<script src="/assets/js/myjs.js"></script>
<script>
    getMyArtcleList(1);
    var type = 0;
    $('#myTab a').on('click', function (e) {
        $('#artcleListPagination').html('');
        type = $(this).attr('data-target');
        getMyArtcleList(type);
    })

    //删除文章
    function deleteArtcle(id) {
        var param = {
            id: id,
        }
        ajaxReuest('/deleteArtcle', param, getMyArtcleList, type);
    }
</script>
</body>
</html>