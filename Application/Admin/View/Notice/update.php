<extend name="./Application/Admin/View/Base.php"/>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">新建公告</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label>标题:</label>
                        <input class="form-control" name="title" value="<?php echo $noticeInfo['title']?>">
                    </div>

                    <div class="form-group">
                        <label>内容:</label>
                        <textarea class="form-control" rows="15" style="width: 500px;" name="content"><?php echo $noticeInfo['content']?></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary" value="确定">
                </div>

            </div>
        </form>
        <!-- /.row -->
    </div>
</block>

