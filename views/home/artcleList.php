<!--最新文章 start-->
<div class="artcle_list">
    <h5 class="card-header bg-white">
        <span class="glyphicon glyphicon-th-list icon"></span>
        <span id="listCategory"></span>
    </h5>
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