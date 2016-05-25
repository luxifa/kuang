<extend name="./Application/Admin/View/Base.php"/>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">设置矿产量</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form" action="" method="POST">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <label>请输入要设置的矿产量,默认明天生效:</label>
                <input class="form-control" name="oreNum">
                <input type="submit" class="btn btn-primary" value="确定">
            </div>
        </div>
            </form>
        <!-- /.row -->
    </div>
</block>

