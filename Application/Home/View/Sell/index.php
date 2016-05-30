<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>卖出矿石</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/pwd.css">
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
    <div class="title">卖出矿石</div>

    <div class="form">

        <form action="" method="post">
            <label class="ipt"><span>卖出数量：</span><input value="<?php echo $oreTotal;?>" type="text" name="oreNum" class="iptText"/></label>

            <div class="btns">
                <button class="defaultBtn submitBtn middleBtn">确定</button>
            </div>

        </form>

    </div>


</div>
<div class="footer">

</div>


</body>
</html>