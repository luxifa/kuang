<extend name="./Application/Admin/View/Base.php"/>
<block name="Main">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">修改用户数据</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <form role="form" action="" method="POST">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <label for="disabledSelect">用户id:</label>
                        <input class="form-control" type="text" value="<?php echo $userInfo['id']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">用户名</label>
                        <input class="form-control" type="text" value="<?php echo $userInfo['user_name']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">矿机总数</label>
                        <input class="form-control"  type="text" value="<?php echo $userInfo['oremachine_num']?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">总矿数</label>
                        <input class="form-control" type="text" name="oreTotal" value="<?php echo (int)$userInfo['ore_total']?>">
                    </div>
                    <div class="form-group">
                        <label for="disabledSelect">新增矿机</label>
                        <input class="form-control" type="text" name="addOremachineNum">
                    </div>
                    <div class="form-group">
                        <label>操作用户</label>
                        <select class="form-control" name="userStatus">
                            <?php foreach($userStatusConf as $key => $value){?>
                                <option value="<?php echo $key;?>" <?php if($key == $userInfo['status']) echo "selected=selected"?>><?php echo $value;?></option>
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

