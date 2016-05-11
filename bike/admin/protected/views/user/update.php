<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">员工管理</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">添加员工</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-envelope"></span> 员工信息</div>
                <div class="panel-body">
                    <?php $form = $this->beginWidget('CActiveForm'); ?>
                    <fieldset>
                        <!-- Name input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">用户名</label>

                            <div class="col-md-9">
                                <?php echo $form->textField($user_info,'username',array('placeholder'=>'请填写用户名','class'=>'form-control')) ?>
                            </div>
                        </div>

                        <!-- Email input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">密码</label>

                            <div class="col-md-9">
                                <?php echo $form->textField($user_info,'password',array('placeholder'=>'请填写密码','class'=>'form-control')) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">管辖店铺</label>

                            <div class="col-md-9">
                                <?php echo $form->dropDownList($user_info,'shop_id',$options,array('class'=>'form-control')); ?>
                            </div>
                        </div>

                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">员工备注</label>

                            <div class="col-md-9">
                                <?php echo $form->textArea($user_info,'user_info',array('placeholder'=>'请填写员工备注信息...','class'=>'form-control')) ?>
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