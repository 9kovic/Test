<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="<?php echo CSS_URL ?>bootstrap.css">
    <style type="text/css">
        .errorrow {
            margin-top: 150px;
        }

        .bodybg {
            background: #FFFFFF left no-repeat;
            height: 350px;
        }

        h3 {
            text-align: center;
        }

        .textbody {
            padding-top: 100px;
            padding-left: 400px;
            font-family: 微软雅黑;
            font-style: italic;
            font-weight: bold;
            font-size: 30px;
            color: #6D9CB8;
        }

        .jump {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="row errorrow">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="login-panel panel adminlogin">
            <div class="panel-heading"><h3><?php echo $title;?></h3></div>
            <div class="panel-body bodybg">

                <?php if($type==0):?>
                    <div class="textbody" id="errorbody"><?php echo($msg);?></div>
                <?php else:?>
                    <div class="textbody" id="rightbody"><?php echo($msg);?></div>
                <?php endif;?>
            </div>
            <div class="panel-footer">
                <p class="jump">
                    页面自动 <a id="href" href="<?php echo($jumpurl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b>
                </p>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
<script src="<?php echo JS_URL ?>jquery-1.11.1.js"></script>
<script type="text/javascript">
    $(function () {


        if ($(".textbody").prop("id") == "errorbody") {
            $(".textbody").html(" 你 没 有 权 限 ！");
            $(".bodybg").css("backgroundImage", "url(<?php echo IMAGE_URL?>errorbg.jpg)");
            $(".panel").addClass("panel-danger");
            $(".panel-heading>h3").html("警 告")

        } else if ($(".textbody").prop("id") == "rightbody") {
            $(".textbody").html(" 欢 迎 使 用 ！");
            $(".bodybg").css("backgroundImage", "url(<?php echo IMAGE_URL?>rightbg.jpg)");
            $(".panel").addClass("panel-primary")
            $(".panel-heading>h3").html("欢 迎")
        }


        var wait = document.getElementById('wait'), href = document.getElementById('href').href;
        totaltime = parseInt(wait.innerHTML);
        var interval = setInterval(function () {
            var time = --totaltime;
            wait.innerHTML = "" + time;
            if (time === 0) {
                location.href = href;
                clearInterval(interval);
            }
        }, 1000);
    });

</script>
</body>
</html>