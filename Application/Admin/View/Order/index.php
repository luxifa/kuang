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
                <h1 class="page-header">订单管理</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>订单id</th>
                                    <th>用户名</th>
                                    <th>用户微信昵称</th>
                                    <th>购买矿机数</th>
                                    <th>支付金额</th>
                                    <th>状态</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($orderList as $orderRow){?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $orderRow['id']?></td>
                                        <td><?php echo $orderRow['user_name']?></td>
                                        <td><?php echo $orderRow['wechat_nickname']?></td>
                                        <td><?php echo $orderRow['oremachine_num']?></td>
                                        <td><?php echo $orderRow['payment_money']?></td>
                                        <td><?php echo $orderStatusConf[$orderRow['status']]?></td>
                                        <td><?php echo date('Y-m-d H:i:s',$orderRow['create_time'])?></td>
                                        <td><a href="/admin/order/update?id=<?php echo $orderRow['id']?>">修改</a></td>
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
                                    <li><a href="/admin/order?page=<?php echo $pageNow-1;?>">&laquo;</a></li>
                                <?php }?>
                                <?php
                                if($totalPage > 6 && $i==3) echo '...';
                                ?>
                                <li><a href="/admin/order?page=<?php echo $i;?>">1</a></li>
                                <?php if($pageNow < $totalPage){?>
                                    <li><a href="/admin/order?page=<?php echo $pageNow+1;?>">&laquo;</a></li>
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