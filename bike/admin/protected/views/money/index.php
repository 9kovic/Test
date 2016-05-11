<script src="<?php echo JS_URL ?>chart-data.js"></script>
<script>

     barChartData = {
        labels : <?php echo $shop_names; ?>,
        datasets : [
            //{
            //	fillColor : "rgba(220,220,220,0.5)",
            //	strokeColor : "rgba(220,220,220,0.8)",
            //	highlightFill: "rgba(220,	220,220,0.75)",
            //	highlightStroke: "rgba(220,220,220,1)",
            //	data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
            //},
            {
                fillColor : "rgba(48, 164, 255, 0.2)",
                strokeColor : "rgba(48, 164, 255, 0.8)",
                highlightFill : "rgba(48, 164, 255, 0.75)",
                highlightStroke : "rgba(48, 164, 255, 1)",
                data : <?php echo $shop_reals; ?>
            },
        ]

    }

      lineChartData = {
         labels : <?php echo $months; ?>,
         datasets : [
             //{
             //	label: "My First dataset",
             //	fillColor : "rgba(220,220,220,0.2)",
             //	strokeColor : "rgba(220,220,220,1)",
             //	pointColor : "rgba(220,220,220,1)",
             //	pointStrokeColor : "#fff",
             //	pointHighlightFill : "#fff",
             //	pointHighlightStroke : "rgba(220,220,220,1)",
             //	data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
             //},
             {
                 label: "My Second dataset",
                 fillColor : "rgba(48, 164, 255, 0.2)",
                 strokeColor : "rgba(48, 164, 255, 1)",
                 pointColor : "rgba(48, 164, 255, 1)",
                 pointStrokeColor : "#fff",
                 pointHighlightFill : "#fff",
                 pointHighlightStroke : "rgba(48, 164, 255, 1)",
                 data : <?php echo $month_real; ?>
             }
         ]

     }


</script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">财务管理</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">财务管理</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">车辆出租</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">费用信息</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="bar-chart" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
    <!--table-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">财务统计</div>
                <div class="panel-body">
                    <table id="mytable" data-toggle="table" data-show-refresh="true"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"> 日期</th>
                            <th data-field="bike_id" data-sortable="true"> 车辆 ID</th>
                            <th data-field="bike_number" data-sortable="true"> 车辆 编号</th>
                            <th data-field="rent_start_time" data-sortable="true"> 出租时间</th>
                            <th data-field="rent_end_time" data-sortable="true"> 归还时间</th>
                            <th data-field="shop_name" data-sortable="true"> 出租店铺</th>
                            <th data-field="rent_price" data-sortable="true"> 出租金额</th>
                            <th data-field="deposit" data-sortable="true"> 押金</th>
                            <th data-field="back_deposit" data-sortable="true"> 退还押金</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">监控信息</div>
                <div class="panel-body">
                    <table id="mytable1" data-toggle="table" data-show-refresh="true"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc">
                        <thead>
                        <tr>
                            <th data-field="system_time" data-checkbox="true"> 日期</th>
                            <th data-field="bike_id" data-sortable="true"> 车辆 ID</th>
                            <th data-field="bike_number" data-sortable="true"> 车辆 编号</th>
                            <th data-field="gps_number" data-sortable="true"> GPS 编号</th>
                            <th data-field="shop_name" data-sortable="true"> 出租店铺</th>
                            <th data-field="gps_time" data-sortable="true"> 外出时间</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/.row-->

<!--    <div class="row">-->
<!--        <div class="col-md-6">-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">按日查询</div>-->
<!--                <br>-->
<!--                <div class="panel-body">-->
<!--                    <form method="get" action="#">-->
<!--                        <div class="form-group">-->
<!--                            <div class="controls input-append date form_date" data-date=""-->
<!--                                 data-date-format="yyyy MM dd"-->
<!--                                 data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">-->
<!--                                <div class="input-group">-->
<!--                                    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>-->
<!--                                    </div>-->
<!--                                    <lable><input type="text" class="form-control" value="" readonly-->
<!--                                                  placeholder="请选择日期"/>-->
<!--                                    </lable>-->
<!--                                </div>-->
<!--                                <span class="add-on"><i class="icon-remove"></i></span>-->
<!--                                <span class="add-on"><i class="icon-th"></i></span>-->
<!--                            </div>-->
<!--                            <input type="hidden" id="dtp_input2" value=""/><br/><br/>-->
<!--                            <button type="button" id="mybt" class="btn btn-primary btn-block"> 查 询</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--            <br/>-->
<!--            <div class="row">-->
<!--                <div class="col-xs-6 col-md-6">-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-body easypiechart-panel">-->
<!--                            <h4>Label:</h4>-->
<!---->
<!--                            <div class="easypiechart" id="easypiechart-blue" data-percent="92"><span-->
<!--                                    class="percent">92%</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-xs-6 col-md-6">-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-body easypiechart-panel">-->
<!--                            <h4>Label:</h4>-->
<!---->
<!--                            <div class="easypiechart" id="easypiechart-red" data-percent="27"><span-->
<!--                                    class="percent">27%</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div><!--/.row-->
<!--        </div>-->
<!--        <div class="col-md-6">-->
<!--            <div class="panel panel-default">-->
<!--                <div class="panel-heading">环形统计图</div>-->
<!--                <div class="panel-body">-->
<!--                    <div class="canvas-wrapper">-->
<!--                        <canvas class="chart" id="doughnut-chart"></canvas>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div><!--/.row-->


</div>    <!--/.main-->
<script>
    $("#mytable").bootstrapTable({
        data:<?php echo $rent_infos; ?>
    })

    $("#mytable1").bootstrapTable({
        data:<?php echo $warning_list; ?>
    })
</script>
<script>
    $('#calendar').datepicker({});

    !function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
<script type="text/javascript">
    $('.form_datetime').datepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    $('.form_date').datepicker({
        language: 'fr',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('.form_time').datepicker({
        language: 'fr',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>
