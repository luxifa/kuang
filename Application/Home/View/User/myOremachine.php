<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>我的矿机</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/list.css">
</head>
<body>
<div class="header">
    <div class="top">
        <a href="/" class="logo ll"><img src="__PUBLIC__/images/logo.png" width="119"></a>
			<span class="rr">
                <a href="/my-account">我的首页</a>
				<a href="/my-account/info">我的收款二维码</a>
                <a href="/my-account/my-oremachine">我的矿机</a>
				<a href="/my-account/reset-password">安全中心</a>
				<a href="/logout">安全退出</a>
			</span>
    </div>
</div>
<div class="main">
    <div class="title">我的矿机</div>
    <table class="table" cellpadding="0" cellspacing="0" >
        <tr>
            <th>矿机id</th>
            <th>剩余产量</th>
            <th>开始工作时间</th>
            <th>最近生产时间</th>
            <th>状态</th>
        </tr>
        <?php foreach($kuangUserOremachineList as $ul){?>
        <tr>
            <td><?php echo '矿机'.$ul['id'];?></td>
            <td><?php echo $ul['residual_yield'];?></td>
            <td><?php echo date('Y-m-d',$ul['effective_time']);?></td>
            <td><?php echo date('Y-m-d',$ul['lately_make_time']);?></td>
            <td>
            <?php if($ul['residual_yield'] < 0){
                        echo $statusConf[2];
                  }else{
                        echo $statusConf[$ul['status']];
                  }

            ?>
            </td>
        </tr>
        <?php }?>
    </table>

    <!--<div class="page">
        <a href="#">上一页</a>
        <a href="#">1</a>
        <b>2</b>
        <a href="#">3</a>
        ...
        <a href="#">10</a>
        <a href="#">下一页</a>
    </div>-->

</div>
<div class="footer">

</div>


</body>
</html>