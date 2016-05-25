<extend name="./Application/Admin/View/Base.php"/>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">修改矿产量</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <label>请输入要修改的矿产量:</label>
                    <input class="form-control" name="oreNum" value="<?php echo $oreManagerInfo['ore_yield']?>">
                    <input type="submit" class="btn btn-primary" value="确定">
                </div>
            </div>
        </form>
        <!-- /.row -->
    </div>
</block>

