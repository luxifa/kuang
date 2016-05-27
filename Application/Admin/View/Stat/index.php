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
                <h1 class="page-header">统计管理</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/admin/stat/create"><button type="button" class="btn btn-primary">新建统计</button></a>
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>卖出量</th>
                                    <th>矿产量</th>
                                    <th>时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($statList as $statRow){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $statRow['id']?></td>
                                        <td><?php echo $statRow['sell_total']?></td>
                                        <td><?php echo $statRow['make_total']?></td>
                                        <td><?php echo date('Y-m-d',$statRow['create_time'])?></td>
                                        <td>
                                            <a href="/admin/stat/update?id=<?php echo $statRow['id']?>">修改</a>
                                            <a href="/admin/stat/delete?id=<?php echo $statRow['id']?>">删除</a>
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
                                    <li><a href="/admin/stat?page=<?php echo $pageNow-1;?>">&laquo;</a></li>
                                <?php }?>
                                <?php
                                if($totalPage > 6 && $i==3) echo '...';
                                ?>
                                <li><a href="/admin/stat?page=<?php echo $i;?>">1</a></li>
                                <?php if($pageNow < $totalPage){?>
                                    <li><a href="/admin/stat?page=<?php echo $pageNow+1;?>">&laquo;</a></li>
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