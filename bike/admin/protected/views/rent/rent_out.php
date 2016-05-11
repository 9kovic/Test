<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">出租车辆</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">出租车辆</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> 出租信息</div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'product-form',
                            'enableAjaxValidation'=>false,
                            'htmlOptions'=>array('enctype'=>'multipart/form-data'),
                        )); ?>

                        <div class="form-group">
                            <label>车辆 ID</label>
                            <?php echo $form->textField($add_form, 'bike_id', array('readonly' => 'readonly', 'class' => 'form-control', 'value' => $bike_info->bike_number)) ?>
                            <?php echo $form->error($add_form,'bike_id') ?>
                        </div>

                        <div class="form-group">

                            <?php echo $form->textField($add_form, 'customer_id', array('placeholder'=>' 客户身份证号码','class' => 'form-control')) ?>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <br/>

                                -- 上 传 身 份 证 照 片 --
                                <?php echo CHtml::activeFileField($add_form, 'customer_id_img', array('class' => 'btn btn-warnning')); ?>

                            </div>

                        </div>

                        <div class="form-group">
                            <label> 备注信息</label>
                            <?php echo $form->textArea($add_form, 'message', array('class' => 'form-control', 'placeholder' => ' 请填写出租备注信息...')) ?>
                        </div>

                        <label> 费用信息</label>

                        <div class="form-group has-success">
                            <?php echo $form->textField($add_form, 'rent_price', array('class' => 'form-control', 'placeholder' => '出租 费用')) ?>
                        </div>
                        <div class="form-group has-warning">
                            <?php echo $form->textField($add_form, 'deposit', array('class' => 'form-control', 'placeholder' => ' 出租 押金')) ?>
                        </div>
                        <div class="form-group has-error">
                            <?php echo $form->textField($add_form, 'customer_tel', array('class' => 'form-control', 'placeholder' => ' 客户 电话')) ?>
                        </div>
                        <input type="submit" value="提交信息" class="btn btn-danger btn-block"/>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div><!--/.main-->