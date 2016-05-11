<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">店铺管理</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">添加店铺</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-envelope"></span> 店铺信息</div>
                <div class="panel-body">
                    <?php $form = $this->beginWidget('CActiveForm') ?>
                    <fieldset>
                        <!-- Name input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">店铺名称</label>

                            <div class="col-md-9">
                                <?php echo $form->textField($shop_model, 'shop_name', array('placeholder' => '请填写店铺名称', 'class' => 'form-control', 'value' => $shop_info->shop_name)) ?>
                            </div>
                        </div>

                        <!-- Email input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">店铺地址</label>

                            <div class="col-md-9">
                                <?php echo $form->textField($shop_model, 'shop_address', array('placeholder' => '请填写店铺地址', 'class' => 'form-control', 'value' => $shop_info->shop_address)) ?>
                            </div>

                        </div>
                        <!--获取经纬度-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">店铺位置</label>

                            <div class="col-md-9 control-label">
                                <?php echo $form->textField($shop_model, 'shop_jwd', array('placeholder' => '点击地图获取经纬度', 'class' => 'form-control', 'id' => 'clickaddshop', 'readonly' => 'readonly', 'value' => $shop_info->shop_jwd)) ?>
                                <div id="addshopmap"></div>
                            </div>

                        </div>
                        <!--over-->

                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">店铺备注</label>

                            <div class="col-md-9">
                                <?php echo $form->textArea($shop_model, 'shop_info', array('placeholder' => '请填写店铺备注信息', 'class' => 'form-control', 'value' => $shop_info->shop_info)) ?>
                                <?php echo "<script>document.getElementById('Shop_shop_info').value='$shop_info->shop_info'</script>" ?>
                            </div>
                        </div>

                        <!-- Form actions -->
                        <div class="form-group">
                            <label class="col-md-3"></label>

                            <div class="col-md-9 widget-right">
                                <button type="submit" class="btn btn-primary btn-block pull-right">提交</button>
                            </div>
                        </div>
                    </fieldset>
                    <?php $this->endWidget(); ?>
                </div>
            </div>

        </div><!--/.col-->

    </div><!--/.row-->
</div>    <!--/.main-->

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=d0Zr9IoStVmK4zMWVhwtLnRy"></script>
<script>// 百度地图API功能
    var map = new BMap.Map("addshopmap");
    map.centerAndZoom("丽江", 12);
    //单击获取点击的经纬度
    map.addEventListener("click", function (e) {
        $("#clickaddshop").val(e.point.lng + "," + e.point.lat)
    });

    addMapControl();

    //地图控件添加函数：
    function addMapControl() {
        //向地图中添加缩放控件
        var ctrl_nav = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_LARGE});
        map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
        var ctrl_ove = new BMap.OverviewMapControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 1});
        map.addControl(ctrl_ove);
    }


</script>