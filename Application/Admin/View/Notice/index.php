<extend name="./Application/Admin/View/Base.php"/>
<block name="css">
    <!-- Timeline CSS -->
    <link href="__PUBLIC__/bootstrap/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <!--<link href="__PUBLIC__/bootstrap/admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">-->
</block>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">公告管理</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/notice/create"><button type="button" class="btn btn-primary">新建公告</button></a>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>公告id</th>
                                    <th>标题</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($noticeList as $noticeRow){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $noticeRow['id']?></td>
                                        <td><?php echo $noticeRow['title']?></td>
                                        <td><?php echo date('Y-m-d',$noticeRow['create_time'])?></td>
                                        <td>
                                            <a href="/admin/notice/update?id=<?php echo $noticeRow['id']?>">修改</a>
                                            <a href="/admin/notice/delete?id=<?php echo $noticeRow['id']?>">删除</a>
                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination">
                            <?php for ($i = 1;$i <= $totalPage; $i++){?>
                                <?php
                                if($i == 6) break;
                                ?>
                                <?php if($pageNow > 1){?>
                                    <li><a href="/admin/notice?page=<?php echo $pageNow-1;?>">&laquo;</a></li>
                                <?php }?>
                                <?php
                                if($totalPage > 6 && $i==3) echo '...';
                                ?>
                                <li><a href="/admin/notice?page=<?php echo $i;?>">1</a></li>
                                <?php if($pageNow < $totalPage){?>
                                    <li><a href="/admin/notice?page=<?php echo $pageNow+1;?>">&laquo;</a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                        <!-- /.table-responsive -->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>

    </div>
</block>
<block name="js">
    <script src="__PUBLIC__/bootstrap/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="__PUBLIC__/bootstrap/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
</block>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>