<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">员工管理</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">员工管理</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">员工信息</div>

                <div class="panel-body">
                    <a href="./index.php?r=User/add" class="btn btn-warning">添加员工</a>
                    <table id="mytable" data-toggle="table" data-show-refresh="true"
                           data-show-toggle="true" data-show-columns="true" data-search="true"
                           data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name"
                           data-sort-order="desc">
                        <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true">店名</th>
                            <th data-field="username" data-sortable="true">用户名</th>
                            <th data-field="password" data-sortable="true">密码</th>
                            <th data-field="shop_name" data-sortable="true">所属店铺</th>
                            <th data-field="user_info" data-sortable="true">基本信息</th>
                            <th data-field="user_id" data-sortable="true">操作</th>
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
        data:<?php echo $user_list; ?>
    })
</script>