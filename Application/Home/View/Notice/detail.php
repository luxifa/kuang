<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>文章详情</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/detials.css">
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
    <div class="title"><?php echo $noticeInfo['title'];?></div>
    <div class="time"><?php echo date('Y-m-d H:i:s',$noticeInfo['create_time']);?></div>
    <div class="article-content">
        <?php echo $noticeInfo['content']?>
    </div>
</div>
<div class="footer">

</div>


</body>
</html>