<!--文章评论 start-->
<div class="artcle_comment">
    <h6 class="mb-3 font-weight-bold">说点什么</h6>
    <textarea class="col-md-12" id="comment" name="comment" rows="5" required="required"
              placeholder="请留下您宝贵的意见"></textarea>
    <input type="button" value="发表" class="btn btn-danger w-25">
</div>
<!--文章评论 end-->
<div class="comment">
    <ul class="list-unstyled mt-5" id="commentList"></ul>
</div>
<nav aria-label="Page navigation example">
    <ul id="commentPagination" class="pagination"></ul>
</nav>
<script type="text/javascript">
    $(document).ready(function () {
        var artcleId = <?= $artcle['aid'] ?>;
        getCommentList(artcleId);
    });
</script>