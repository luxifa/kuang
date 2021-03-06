<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My Account</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/public.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/a4.css">
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
    <div class="wrap-left ll">
        <div class="wrap1 clearfix">
            <div class="ll">
                <div class="head1">
                    <span>累计矿石</span>
                    <span><?php echo $oreTotal;?>个</span>
                </div>
                <div class="group">
                    <div class="group-title">矿机状态</div>
                    <div class="group-content">
                        <img src="__PUBLIC__/images/images/kuangji.gif">
                    </div>
                    <div class="group-bar">
                        <span>正在运作的矿机: <i><?php echo $kuangUserOremachineCount;?> 台</i></span>
                    </div>
                    <div class="group-bar">
                        <span>每台今日开采: <i><?php echo $oreYield;?> 个</i></span>
                    </div>
                    <div class="group-bar">
                        <span>今日累计生产: <i><?php echo $dayCount;?> 个</i></span>
                    </div>
                </div>
            </div>
            <div class="rr">
                <div class="head2">
                    <a href="/sell" class="btn1">卖出矿石</a>
                    <a href="/shop" class="btn2">购买矿机</a>
                </div>
                <div class="group">
                    <div class="group-title">最新公告</div>
                    <div class="group-content">
                        <?php foreach($noticeList as $nl){?>
                            <a href="/notice/detail?id=<?php echo $nl['id'];?>"><span class="ll"><?php echo $nl['title']?></span><span class="rr"><?php echo date('Y-m-d',$nl['create_time'])?></span></a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap2" id="myChart">

        </div>

    </div>
    <div class="wrap-right rr">
        我的邀请码: <span><?php echo $inviteCode;?></span>
    </div>
    <?php if($buyIngOremachineNum){?>
    <div class="wrap-right rr">
        购买中的矿机: <span><?php echo $buyIngOremachineNum;?>台</span>
    </div>
    <?php }?>
    <?php if($kuangUserOremachineWaitCount){?>
        <div class="wrap-right rr">
            待生产的矿机: <span><?php echo $kuangUserOremachineWaitCount;?>台</span>
        </div>
    <?php }?>
</div>
<div class="footer">

</div>


<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.2.min.js"></script>
<script src="__PUBLIC__/js/echarts.common.min.js"></script>

<script type="text/javascript">

    var myChart = echarts.init(document.getElementById('myChart'));

    option = {
        title : {
            text: '',
            subtext: ''
        },
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['卖出量','矿产量']
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [
                    '<?php echo date('Y-m-d',$statList[6]['create_time'])?>',
                    '<?php echo date('Y-m-d',$statList[5]['create_time'])?>',
                    '<?php echo date('Y-m-d',$statList[4]['create_time'])?>',
                    '<?php echo date('Y-m-d',$statList[3]['create_time'])?>',
                    '<?php echo date('Y-m-d',$statList[2]['create_time'])?>',
                    '<?php echo date('Y-m-d',$statList[1]['create_time'])?>',
                    '<?php echo date('Y-m-d',$statList[0]['create_time'])?>'
                ]
            }
        ],
        yAxis : [
            {
                type : 'value',
                axisLabel : {
                    formatter: '{value}'
                }
            }
        ],
        series : [
            {
                name:'卖出量',
                type:'line',
                data:[
                    <?php echo $statList[6]['sell_total']?>,
                    <?php echo $statList[5]['sell_total']?>,
                    <?php echo $statList[4]['sell_total']?>,
                    <?php echo $statList[3]['sell_total']?>,
                    <?php echo $statList[2]['sell_total']?>,
                    <?php echo $statList[1]['sell_total']?>,
                    <?php echo $statList[0]['sell_total']?>
                ],
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name: '平均值'}
                    ]
                }
            },
            {
                name:'矿产量',
                type:'line',
                data:[
                    <?php echo $statList[6]['make_total']?>,
                    <?php echo $statList[5]['make_total']?>,
                    <?php echo $statList[4]['make_total']?>,
                    <?php echo $statList[3]['make_total']?>,
                    <?php echo $statList[2]['make_total']?>,
                    <?php echo $statList[1]['make_total']?>,
                    <?php echo $statList[0]['make_total']?>
                ],
                markPoint : {
                    data : [
                        {type : 'max', name: '最大值'},
                        {type : 'min', name: '最小值'}
                       // {name : '周最低', value : 2, xAxis: 1, yAxis: 1.5}
                    ]
                },
                markLine : {
                    data : [
                        {type : 'average', name : '平均值'}
                    ]
                }
            }
        ]
    };


    myChart.setOption(option);

</script>

</body>
</html>
