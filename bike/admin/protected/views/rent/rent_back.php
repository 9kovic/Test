<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">归还车辆</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">归还车辆</h1>
        </div>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"> 归还信息</div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <?php $form=$this->beginWidget('CActiveForm')?>

                            <div class="form-group">
                                <label> 归还 车辆 ID</label>
                                <input class="form-control" placeholder=" 归还 车辆 ID" readonly="readonly" value="<?php echo $rent_info->bike_number ?>">
                            </div>

                            <div class="form-group">
                                <label> 归还 押金 金额</label>
                                <?php echo $form->textField($rent_info,'back_deposit',array('placeholder'=>'请填写车辆  ID','class'=>'form-control','value'=>$rent_info->deposit)) ?>
                            </div>


                            <div class="form-group">
                                <label> 备注信息</label>
                                <?php echo $form->textArea($rent_info,'message',array('class'=>'form-control')) ?>
                            </div>

                            <input type="submit" value="提交信息" class="btn btn-danger btn-block"/>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->