<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="__PUBLIC__/bootstrap/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">

        body {
            background-color: #18bc9c;
        }

        .panel-heading {
            padding: 5px 15px;
        }

        .panel-footer {
            padding: 1px 15px;
            color: #A0A0A0;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            /*-moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;*/
        }
    </style>
    <script src="__PUBLIC__/bootstrap/admin/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="__PUBLIC__/bootstrap/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> 登录M+</strong>
                </div>
                <div class="panel-body">
                    <form role="form" action="#" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="center-block">
                                    <a href="/"><img class="profile-img"
                                         src="__PUBLIC__/images/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-user"></i>
												</span>
                                            <input class="form-control" placeholder="用户名" name="userName" type="text" autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span>
                                            <input class="form-control" placeholder="密码" name="password" type="password" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="验证码" name="verifyCode" type="text" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <img src="/auth/verify" id="getcode_num" title="看不清，点击换一张">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="登录">
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer ">
                    还没有账号? <a href="/register" onClick=""> 点击这里注册 </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        //数字验证
        $("#getcode_num").click(function(){
            $(this).attr("src",'/auth/verify?' + Math.random());
        });
    });
</script>
</body>
</html>
