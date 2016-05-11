<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">车辆管理</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">添加车辆</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-envelope"></span> 车辆信息</div>
                <div class="panel-body">
                    <?php $form = $this->beginWidget('CActiveForm'); ?>
                        <fieldset>
                            <!-- Name input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="name">车辆 ID</label>

                                <div class="col-md-9">
                                    <?php echo $form->textField($add_form,'bike_number',array('placeholder'=>'请填写车辆  ID','class'=>'form-control')) ?>
                                </div>
                            </div>

                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">GPS 设备号</label>

                                <div class="col-md-9">
                                    <?php echo $form->textField($add_form,'gps_number',array('placeholder'=>'请填写 GPS 设备号','class'=>'form-control')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">SIM 号</label>

                                <div class="col-md-9">
                                    <?php echo $form->textField($add_form,'sim_number',array('placeholder'=>'请填写 sim号','class'=>'form-control')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">所属店铺</label>

                                <div class="col-md-9">
                                    <?php echo $form->dropDownList($add_form,'shop_id',$options,array('class'=>'form-control')); ?>
                                </div>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="message">车辆备注</label>

                                <div class="col-md-9">
                                    <?php echo $form->textArea($add_form,'bike_info',array('placeholder'=>'请填写车辆备注信息...','class'=>'form-control')) ?>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <label class="col-md-3"></label>

                                <div class="col-md-9 widget-right">
                                    <button type="submit" class="btn btn-primary btn-block pull-right">提交</button>`
                                </div>
                            </div>
                        </fieldset>
                    <?php $this->endWidget(); ?>
                </div>
            </div>

        </div><!--/.col-->

    </div><!--/.row-->
</div>    <!--/.main-->