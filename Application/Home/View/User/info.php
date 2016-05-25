
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>a3</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/a3.css">
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
<div class="main clearfix">
    <div class="ll">
        <img src="__PUBLIC__/images/a3-1.png" >
    </div>
    <div class="rr">
        <form id="form" enctype="multipart/form-data" action="" method="post">
            <p class="col-333">上传你的微信收款二维码</p>

            <div class="j-upload"></div>

            <button class="defaultBtn submitBtn middleBtn largeBtn">确定</button>
        </form>


    </div>
</div>
<div class="footer">

</div>


<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/imguploader.js"></script>

<script type="text/javascript">

    $(function(){
        $( '.j-upload' ).imguploader({
            max:1,
            fileName:'photo',
            text:''
        });
    });

</script>

</body>
</html>