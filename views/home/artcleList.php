<!--最新文章 start-->
<div class="artcle_list">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white p-0 m-0 mb-2">
            <li class="text-muted border-0"><span class="glyphicon glyphicon-map-marker mr-1"></span>当前位置：</li>
            <li class="breadcrumb-item border-0"><a href="/" class="text-muted">首页</a></li>
            <li class="breadcrumb-item border-0"><a href="#" class="text-muted" id="listCategory"></a></li>
            <li class="breadcrumb-item active" aria-current="page">列表</li>
        </ol>
    </nav>
    <ul class="list-unstyled" id="artcleList"></ul>
</div>
<!--最新文章 end-->
<nav aria-label="Page navigation example">
    <ul id="artcleListPagination" class="pagination"></ul>
</nav>
<script type="text/javascript">
    $(document).ready(function () {
        getArtcleList(GetRequest());
    });
</script>