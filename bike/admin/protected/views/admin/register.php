<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL ?>bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_URL ?>styles.css"/>
    <script src="<?php echo JS_URL ?>jquery-1.11.1.js"></script>
</head>
<body>
<div class="container">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="panel panel-primary adminlogin loginfather">
            <div class="panel-heading login-head"><h3>用户注册</h3></div>
            <div class="panel-body">
                <?php $form=$this->beginWidget('CActiveForm', array(
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                            <?php echo $form->textField($register_form, 'username',array("placeholder"=>"用户账号","class"=>"form-control")) ?>

                        </div>
                        <?php echo $form->error($register_form,'username') ?>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                            <?php echo $form->passwordField($register_form, 'password',array("placeholder"=>"登录密码","class"=>"form-control")) ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                            <?php echo $form->passwordField($register_form, 'password2',array("placeholder"=>"确认密码","class"=>"form-control")) ?>
                        </div>

                    </div>



                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                            <?php echo $form->textField($register_form, 'telphone',array("placeholder"=>"电话号码","class"=>"form-control")) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                            <?php echo $form->textField($register_form, 'email',array("placeholder"=>"邮箱","class"=>"form-control")) ?>
                        </div>
                        <?php echo $form->error($register_form,'email') ?>
                        <?php echo $form->error($register_form,'username') ?>
                        <?php echo $form->error($register_form,'password2') ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" value=" 注 册 " class="btn btn-primary btn-block"/></div>
                    <div class="form-group">
                        <a href="./index.php?r=admin/login" class="btn btn-default btn-block">返回登录页面</a>
                    </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>