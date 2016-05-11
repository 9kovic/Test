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
                    <a href="addcar.html" class="btn btn-warning">添加车辆</a>
                    <?php if (!empty($bike_list)) { ?>
                        <table data-toggle="table" data-url="tables/admincar.json" data-show-refresh="true"
                               data-show-toggle="true" data-show-columns="true" data-search="true"
                               data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                               data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true">车辆 ID</th>
                                <th data-field="id" data-sortable="true">车辆 ID</th>
                                <th data-field="name" data-sortable="true">GPS 设备号</th>
                                <th data-field="price" data-sortable="true">备注信息</th>

                                <th data-field="control" data-sortable="true">操作</th>

                            </tr>
                            </thead>
                            <?php
                            foreach ($bike_list as $v) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $v->bike_number ?></td>
                                    <td><?php echo $v->gps_number ?></td>
                                    <td><?php echo $v->bike_info ?></td>
                                    <td>
                                        <a href="./index.php?r=Rent/RentOut&id=<? echo $v->bike_id ?>"
                                           class="btn btn-warning">出租</a>
                                    </td>
                                </tr>
                            <?php }?>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div><!--/.row-->
    <br/>
    <?php if (!empty($rent_list)) { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">已出租车辆</div>

                <div class="panel-body">


                        <table data-toggle="table" data-url="tables/admincar.json" data-show-refresh="true"
                               data-show-toggle="true" data-show-columns="true" data-search="true"
                               data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                               data-sort-order="desc">
                            <thead>
                            <tr>
                                <th data-field="state" data-checkbox="true">车辆 ID</th>
                                <th data-field="id" data-sortable="true">车辆 ID</th>
                                <th data-field="name" data-sortable="true">电话号码</th>
                                <th data-field="price" data-sortable="true">备注信息</th>

                                <th data-field="control" data-sortable="true">操作</th>

                            </tr>
                            </thead>
                            <?php
                            foreach ($rent_list as $v) { ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $v->bike_number ?></td>
                                    <td><?php echo $v->customer_tel ?></td>
                                    <td><?php echo $v->message ?></td>

                                    <td>

                                        <a href="./index.php?r=Rent/RentBack&id=<? echo $v->bike_id ?>"
                                           class="btn btn-primary">归还</a>

                                    </td>


                                </tr>
                            <?php } ?>
                        </table>

                </div>
            </div>
        </div>
        <?php } ?>
    </div><!--/.row-->
</div><!--/.main-->