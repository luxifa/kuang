<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>支付</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/a6.css">
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
    <p class="t1">应付<?php echo $totalPrice;?>元</p>
    <div class="box">
        <p>扫描二维码付款</p>
        <div class="ewm">
            <img src="__PUBLIC__<?php echo $adminInfo['gathering_img'];?>">
        </div>
        <p>付款后填写付款微信昵称</p>
    </div>
    <form class="j-from" action="/payment" method="POST">
        <div class="arrow"><img src="__PUBLIC__/images/a6.png" width="18"></div>
        <input type="text" class="iptText" name="wechatNickname">
        <div class="arrow"><img src="__PUBLIC__/images/a6.png" width="18"></div>
        <button class="defaultBtn submitBtn middleBtn">确定</button>
    </form>
</div>
<div class="footer">

</div>

</body>
</html>