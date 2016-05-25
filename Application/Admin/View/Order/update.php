<extend name="./Application/Admin/View/Base.php"/>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">修改订单状态</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="disabledSelect">订单id:</label>
                        <input class="form-control" type="text" value="<?php echo $orderInfo['id']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">用户名</label>
                        <input class="form-control" type="text" value="<?php echo $orderInfo['user_name']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">用户微信昵称</label>
                        <input class="form-control" type="text" value="<?php echo $orderInfo['wechat_nickname']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">购买矿机数</label>
                        <input class="form-control"  type="text" value="<?php echo $orderInfo['oremachine_num']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">支付金额</label>
                        <input class="form-control" type="text" value="<?php echo $orderInfo['payment_money']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">创建时间</label>
                        <input class="form-control" type="text" value="<?php echo date('Y-m-d H:i:s',$orderInfo['create_time'])?>" disabled>
                    </div>
                    <div class="form-group">
                        <label>操作订单</label>
                        <select class="form-control" name="orderStatus">
                            <?php foreach($orderStatusConf as $key => $value){?>
                            <option value="<?php echo $key;?>" <?php if($key == $orderInfo['status']) echo "selected=selected"?>><?php echo $value;?></option>
                            <?php }?>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="确定">
                </div>

            </div>
        </form>
        <!-- /.row -->
    </div>
</block>

