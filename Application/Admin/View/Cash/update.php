<extend name="./Application/Admin/View/Base.php"/>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">修改提现状态</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="disabledSelect">提现id:</label>
                        <input class="form-control" type="text" value="<?php echo $cashInfo['id']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">用户名</label>
                        <input class="form-control" type="text" value="<?php echo $cashInfo['user_name']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">提现的矿数量</label>
                        <input class="form-control" type="text" value="<?php echo $cashInfo['cash_ore']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">创建时间</label>
                        <input class="form-control"  type="text" value="<?php echo date('Y-m-d H:i:s',$cashInfo['create_time'])?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>操作提现</label>
                        <select class="form-control" name="cashStatus">
                            <?php foreach($cashStatusConf as $key => $value){?>
                                <option value="<?php echo $key;?>" <?php if($key == $cashInfo['status']) echo "selected=selected"?>><?php echo $value;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="确定">
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="disabledSelect">用户收款二维码:</label>
                        <img src="__PUBLIC__<?php echo $cashInfo['money_img'] ?>" class="img-thumbnail" >
                    </div>

                </div>

            </div>
        </form>
        <!-- /.row -->
    </div>
</block>

