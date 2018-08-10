<!--文章评论 start-->
<div class="artcle_comment">
    <h6 class="mb-3 font-weight-bold">说点什么</h6>
    <textarea class="col-md-12" id="comment" name="comment" rows="5" required="required"
              placeholder="请留下您宝贵的意见"></textarea>
    <input type="button" value="发表" class="btn btn-danger w-25">
</div>
<!--文章评论 end-->
<div class="comment">
    <ul class="list-unstyled mt-5">
        <?php foreach ($commentList as $comment): ?>
            <li class="media pt-3 pb-3">
                <img class="portrait rounded-circle mr-3" src="<?= $comment['portrait'] ?>"
                     alt="用户头像">
                <div class="media-body">
                    <span class="font-weight-bold"><?= $comment['nickName'] ?></span>
                    <span class="ml-3"><?= $comment['create_time'] ?></span>
                    <p class="mt-2">
                        <?= $comment['content'] ?>
                    </p>
                    <p class="comment_nav">
                        <span class="mr-4"><i class="glyphicon glyphicon-heart mr-1"></i>赞</span>
                        <span><i class="glyphicon glyphicon-share-alt mr-1"></i>回复</span>
                    </p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div id="paginator-comment"></div>
</div>
<script type="text/javascript">
    let currentPage = 1;
    let pageSize = 3;

    function render() {
        $.ajax({
            url: "./setPage.php",
            data: {
                page: currentPage,
                pageSize: pageSize
            },
            dataType: "json",
            success: function (result) {
                // 将数据渲染到页面
                $("tbody").html(template("tableTemp", {item: result}))
                // 调用分页函数.参数:当前所在页, 总页数(用总条数 除以 每页显示多少条,在向上取整), ajax函数
                setPage(currentPage, Math.ceil(result[0].size / pageSize), render)
            }
        })
    }

    render()

    /**
     *
     * @param pageCurrent 当前所在页
     * @param pageSum 总页数
     * @param callback 调用ajax
     */
    function setPage(pageCurrent, pageSum, callback) {
        $(".pagination").bootstrapPaginator({
            //设置版本号
            bootstrapMajorVersion: 3,
            // 显示第几页
            currentPage: pageCurrent,
            // 总页数
            totalPages: pageSum,
            //当单击操作按钮的时候, 执行该函数, 调用ajax渲染页面
            onPageClicked: function (event, originalEvent, type, page) {
                // 把当前点击的页码赋值给currentPage, 调用ajax,渲染页面
                currentPage = page
                callback && callback()
            }
        })
    }
</script>