<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购买矿机</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/a7.css">
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
    <div class="wrap">
        <div class="info clearfix">
            <span>已拥有矿机：<i><?php echo $userOremachineCount;?>台</i></span>
            <span>平均每天总矿产量：<i><?php echo $userAvgDayTotalOre;?>矿石</i></span>
        </div>

        <div class="form-box">
            <form class="j-from" action="/shop/create" method="POST">
                <input type="hidden" id="num" value="1" name="oremachineNum">
                <div class="clearfix">
                    <span class="num">1</span>
                    <span class="price"><i>350</i>元</span>
                    <span class="msg">平均日产量<i><?php echo $oreYield;?></i>矿</span>
                    <span class="add"></span>
                    <span class="minus"></span>
                </div>
                <div>
                    <button class="defaultBtn submitBtn middleBtn">购买</button>
                </div>

            </form>
        </div>

        <ul class="tips">
            <li><span>注1</span>：1台矿机的寿命为产量7200矿石报废（生命周期为115天左右），年最高收益7倍左右</li>
            <li><span>注2</span>：当日产矿量可能会受到当日矿石买卖量的轻微影响（上下浮动属正常现象）</li>
            <li><span>注3</span>：当天购买的矿机需要第二天才生效</li>
        </ul>

    </div>

</div>
<div class="footer">

</div>

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">

    $(function(){

        function price(){
            var _num = $( '#num' ).val();
            var _price = _num * 350;
            var _price2 = _num * <?php echo $oreYield;?>;
            $( '.price i' ).html( _price );
            $( '.msg i' ).html( _price2 );
        }

        function num( num ){

            var _num = $( '#num' ).val();
            _num = parseInt( _num ) + parseInt( num );
            $( '#num' ).val( _num );
            $( '.num' ).html( _num );
        }

        $( '.add' ).click(function(){
            if( $( '#num' ).val() >= 30 ){
                return;
            }
            num( 1 );
            price();
        });
        $( '.minus' ).click(function(){
            if( $( '#num' ).val() <= 1 ){
                return;
            }
            num( -1 );
            price();
        });

    });

</script>


</body>
</html>