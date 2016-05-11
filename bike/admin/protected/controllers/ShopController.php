<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/4
 * Time: 12:02
 */

class ShopController extends Controller{

    function actionIndex(){

        $shop_model = Shop::model();
        //获取当前用户的信息
        $admin_model = Admin::model();
        $user = $admin_model->findByAttributes(array('username'=>Yii::app()->user->name));

        if(empty($user)){
            Yii::error('您没有权限查看此项','./index.php?r=Index/Index',3);
            exit;
        }


        $sql = "select * from {{shop}} WHERE delete_flag = 1"." and admin_manager_id = $user->admin_id";
        $shop_list = $shop_model->findAllBySql($sql);
        $shop_list = json_decode(CJSON::encode($shop_list),TRUE);

        foreach($shop_list as $k=>$v){
            $id = $shop_list[$k]['shop_id'];
            $shop_list[$k]['shop_id'] = "<a href=\"./index.php?r=Shop/Update&id=$id\">编辑</a>"."/"."<a href=\"./index.php?r=Shop/Delete&id=$id\">删除</a>";
        }

        $shop_list = json_encode($shop_list);


        $this->render('index',array('shop_list'=>$shop_list));
    }

    function actionAdd(){
        $add_form = new Shop();

        if(isset($_POST['Shop'])){
            //获取当前用户的信息
            $admin_model = Admin::model();
            $user = $admin_model->findByAttributes(array('username'=>Yii::app()->user->name));
            $_POST['Shop']['admin_manager_id'] = $user->admin_id;

            $add_form->attributes = $_POST['Shop'];


            if($add_form->validate()){
                if($add_form->save()){
                    $this->redirect('./index.php?r=Shop/index');
                }
            }

        }

        $this->render('add',array('add_form'=>$add_form));
    }


    function actionUpdate($id){

        $shop_model = Shop::model();

        $shop_info = $shop_model->findByPk($id);

        if(isset($_POST['Shop'])){
            $shop_info->attributes = $_POST['Shop'];
            if($shop_info->validate() && $shop_info->save()){
                $this->redirect('./index.php?r=Shop/index');
            }
        }

        $this->render('update',array('shop_info'=>$shop_info,'shop_model'=>$shop_model));

    }

    function actionDelete($id){
        $shop_model = Shop::model();
        $shop_info = $shop_model->findByPk($id);
        if(!empty($shop_info)){
            $shop_info->delete_flag = 0;
            if($shop_info->save()){
                $this->redirect('./index.php?r=Shop/index');
            }
        }
    }

}