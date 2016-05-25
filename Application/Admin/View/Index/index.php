<extend name="./Application/Admin/View/Base.php"/>
<block name="css">
    <!-- Timeline CSS -->
    <link href="__PUBLIC__/bootstrap/admin/dist/css/timeline.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="__PUBLIC__/bootstrap/admin/bower_components/morrisjs/morris.css" rel="stylesheet">
</block>
<block name="Main">
    <div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">首页</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $todayCountUser;?></div>
                            <div>今日新增用户</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $notHandleCashCount;?></div>
                            <div>待处理的提现</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $notHandleOrderCount;?></div>
                            <div>待处理的订单</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
</block>
<block name="js">
    <script src="__PUBLIC__/bootstrap/admin/bower_components/raphael/raphael-min.js"></script>
    <script src="__PUBLIC__/bootstrap/admin/bower_components/morrisjs/morris.min.js"></script>
    <script src="__PUBLIC__/bootstrap/admin/js/morris-data.js"></script>
</block>
