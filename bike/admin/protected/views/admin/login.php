<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <link href="<?php echo CSS_URL ?>bootstrap.css" rel="stylesheet">
    <link href="<?php echo CSS_URL ?>styles.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?php echo JS_URL ?>html5shiv.js"></script>
    <script src="<?php echo JS_URL ?>respond.js"></script>
    <![endif]-->
    <script src="<?php echo JS_URL ?>jquery-1.11.1.js"></script>
</head>

<body>
<div class="row loginfather">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-primary adminlogin">
            <div class="panel-heading login-head"><h3>管理系统</h3></div>
            <div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
<!--                                <input class="form-control" placeholder=" 帐号" name="email" type="text" required>-->
                                <?php echo $form->textField($login_form, 'username',array("placeholder"=>"账号","class"=>"form-control")) ?>

                            </div>
                            <?php echo $form->error($login_form,'username') ?>
                        </div>


                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
<!--                                <input class="form-control" placeholder=" 密码" name="password" type="password" required>-->
                                <?php echo $form->passwordField($login_form, 'password',array("placeholder"=>"密码","class"=>"form-control")) ?>

                            </div>
                            <?php echo $form->error($login_form,'password') ?>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input name="remember" type="checkbox" value="Remember Me">记住信息
                            </label>
                        </div>
                        <input type="submit" value="登录" class="btn btn-primary btn-block"/>
                        <a href="./index.php?r=admin/register" class="btn btn-default btn-block">注册</a>
                    </fieldset>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->


<script>
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
</body>

</html>
