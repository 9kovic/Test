<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">车辆管理</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">车辆管理</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">车辆信息</div>

                <div class="panel-body">
                    <a href="./index.php?r=Ebike/add" class="btn btn-warning">添加车辆</a>
                    <table id="mytable" data-toggle="table" data-show-refresh="true"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="bike_number"  data-sortable="true">车辆 ID</th>
                            <th data-field="shop_name"  data-sortable="true">所属店铺</th>
                            <th data-field="gps_number"  data-sortable="true">GPS 设备号</th>
                            <th data-field="sim_number"  data-sortable="true">SIM卡号</th>
                            <th data-field="bike_info"  data-sortable="true">备注信息</th>
                            <th data-field="bike_id"  data-sortable="true">操作</th>

                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div><!--/.row-->
</div><!--/.main-->
<script>
    $("#mytable").bootstrapTable({
        data:<?php echo $ebike_list; ?>
    })
</script>