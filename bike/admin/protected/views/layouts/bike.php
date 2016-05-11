<!--
根据用户的需求，需要添加“车辆报修”、“报修处理”和“交接班”的功能。
车辆报修:输入车辆编号，上传照片，提交保修申请。
报修处理:选择报修记录，输入修理内容，选择完成修理。
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="<?php echo CSS_URL ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo CSS_URL ?>bootstrap-table.css" rel="stylesheet">
    <link href="<?php echo CSS_URL ?>styles.css" rel="stylesheet">
    <link href="<?php echo CSS_URL ?>datepicker.css" rel="stylesheet">
    <link href="<?php echo CSS_URL ?>datepicker3.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?php echo JS_URL ?>html5shiv.js"></script>
    <script src="<?php echo JS_URL ?>respond.js"></script>

    <![endif]-->
    <script src="<?php echo JS_URL ?>jquery-1.11.1.js"></script>
    <script src="<?php echo JS_URL ?>bootstrap.js"></script>
    <script src="<?php echo JS_URL ?>chart.js"></script>
    <script src="<?php echo JS_URL ?>bootstrap-table.js"></script>
    <script src="<?php echo JS_URL ?>easypiechart.js"></script>
    <script src="<?php echo JS_URL ?>easypiechart-data.js"></script>
    <script src="<?php echo JS_URL ?>bootstrap-datepicker.js"></script>


</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>管理</span>系统</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                            class="glyphicon glyphicon-user"></span><?php echo Yii::app()->user->name;?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> 简介</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> 设置</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="搜索">
        </div>
    </form>
    <ul class="nav menu" id="navigator">
        <?php
        $admin_model = new Admin();


        $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));

        if(!empty($user)){ ?>


        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> 首页管理</a></li>
        <li><a id="money_link" href="./index.php?r=Money/Index"><span class="glyphicon glyphicon-stats"></span> 财务管理</a></li>
        <li><a href="./index.php?r=User/Index"><span class="glyphicon glyphicon-user"></span> 员工管理</a></li>
        <li><a href="./index.php?r=Ebike/Index"><span class="glyphicon glyphicon-list-alt"></span> 车辆管理</a></li>
        <li><a href="./index.php?r=Shop/Index"><span class="glyphicon glyphicon-globe"></span> 店铺管理</a></li>
        <li><a href="./index.php?r=Track/Index"><span class="glyphicon glyphicon-map-marker"></span> 全景&轨迹</a></li>
            <li><a href="./index.php?r=Admin/LoginOut"><span class="glyphicon glyphicon-off"></span> 退出登录</a></li>
        <?php }else{ ?>
        <li><a href="./index.php?r=Rent/RentIndex"><span class="glyphicon glyphicon-fullscreen"></span> 出租管理</a></li>

        <li><a href="carrepair.html"><span class="glyphicon glyphicon-cog"></span> 报修&处理</a></li>
        <li role="presentation" class="divider"></li>
        <li><a href="exchange.html"><span class="glyphicon glyphicon-adjust"></span> 换班管理</a></li>
        <li><a href="./index.php?r=Admin/LoginOut"><span class="glyphicon glyphicon-off"></span> 退出登录</a></li>
        <?php } ?>
    </ul>
</div><!--/.sidebar-->
<?php  echo $content; ?>


<script>
    $(function(){
        $("#navigator>li").click(function(){
            $(this).addClass("active")
                .siblings().removeClass("active");
        })
    })
</script>


</body>

</html>
