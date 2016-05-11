<?php

/**
 * 管理员控制器
 * User: Administrator
 * Date: 2015/12/31
 * Time: 15:17
 */
class AdminController extends Controller
{

    function actionLogin()
    {
        //框架自带的登陆模型
        $login_form = new LoginForm();

        $admin_model = Admin::model();
        $user = $admin_model->findAllByAttributes(array('username'=>Yii::app()->user->name));

        if(!empty($user)){
            $this->redirect('index.php?r=Index/index');
        }


        if (isset($_POST['LoginForm'])) {
            $login_form->attributes = $_POST['LoginForm'];
            if ($login_form->validate() && $login_form->login()) {
               Yii::success('欢迎','./index.php?r=Index/Index',3);
            }
        }

        $this->renderPartial('login', array('login_form' => $login_form));
    }

    function actionRegister(){
        $register_form = new Admin();

        if (isset($_POST['Admin'])) {

            $_POST['Admin']['password'] = md5($_POST['Admin']['password']);
            $_POST['Admin']['password2'] = md5($_POST['Admin']['password2']);

            $register_form->attributes = $_POST['Admin'];


            if ($register_form->validate()) {
                if($register_form->save()){
                    $this->redirect("./index.php");
                }
            }
        }

        $this->renderPartial('register', array('register_form' => $register_form));
    }

    function actionLoginOut(){
        Yii::app()->session->clear();
        Yii::app()->session->destroy();
        $this->redirect("./index.php");
    }


}