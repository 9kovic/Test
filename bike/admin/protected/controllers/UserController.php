<?php
/**
 * 员工管理控制器
 * User: Administrator
 * Date: 2016/1/6
 * Time: 16:32
 */

class UserController extends Controller{

    /**
     * 显示员工
     */
    public function actionIndex(){
        $admin_model = Admin::model();
        $user_model = User::model();
        $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));


        if(empty($user)){
            Yii::error('您没有权限查看此项','./index.php?r=Index/Index',3);
            exit;
        }


        $sql = "select * from k_user_info,k_shop WHERE k_user_info.shop_id = k_shop.shop_id and k_user_info.admin_manager_id = '" . $user->admin_id . "'"." and k_user_info.delete_flag = 1";
        $connection = Yii::app()->db;
        $user_list = $connection->createCommand($sql)->queryAll();


        foreach($user_list as $k=>$v){
            $id = $user_list[$k]['user_id'];
            $user_list[$k]['user_id'] = "<a href=\"./index.php?r=User/Update&id=$id\">编辑</a>"."/"."<a href=\"./index.php?r=User/Delete&id=$id\">删除</a>";
        }

        $user_list = json_encode($user_list);
        $this->render('index',array('user_list'=>$user_list));

    }


    /**
     * 添加员工
     */
    public function actionAdd(){

        $add_form = new User();

        $admin_model = Admin::model();
        $shop_model = Shop::model();
        $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));

        if (isset($_POST['User'])) {


            $_POST['User']['admin_manager_id'] = $user->admin_id;
            $add_form->attributes = $_POST['User'];

            $shop_info = $shop_model->findByPk($_POST['User']['shop_id']);
            $shop_info->user_flag = 1;


            if ($add_form->validate()) {
                if ($add_form->save()&&$shop_info->save()) {
                    $this->redirect('./index.php?r=User/index');
                }

            }
        } else {
            $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));
            if (!empty($user)) {
                $options = array();
                $sql = "select shop_id,shop_name from {{shop}} WHERE delete_flag = 1 and user_flag = 0 and  admin_manager_id = " . $user->admin_id;
                $shop_list = $shop_model->findAllBySql($sql);
                foreach ($shop_list as $k => $v) {
                    $options[$v->shop_id] = $v->shop_name;
                }

                if(sizeof($options) == 0){
                    Yii::error("店铺数量不足，请先添加店铺","./index.php?r=User/index",3);
                    exit;
                }

                $this->render('add', array('add_form' => $add_form, 'options' => $options));
            }
        }

    }

    /**
     * 修改员工信息
     * @param $user_id
     */
    public function actionUpdate($id){
        $user_model = User::model();
        $user_info = $user_model->findByPk($id);
        $admin_model = Admin::model();
        $shop_model = Shop::model();


        if(isset($_POST['User'])) {

            $shop_info = $shop_model->findByPk($user_info->shop_id);
            $user_info->attributes = $_POST['User'];
            $shop_info2 = $shop_model->findByPk($user_info->shop_id);
            if($user_info->save()&&$user_info->validate()){
                $shop_info->user_flag = 0;
                $shop_info2->user_flag =1;
                if($shop_info->save()&&$shop_info2->save()){
                    $this->redirect('./index.php?r=User/index');
                }
            }


        }else{
            $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));
            $options = array();
            $sql = "select shop_id,shop_name from {{shop}} WHERE delete_flag = 1 and user_flag = 0 and  admin_manager_id = " . $user->admin_id;
            $shop_list = $shop_model->findAllBySql($sql);

            $shop_info = $shop_model->findByPk($user_info->shop_id);
            $options[$shop_info->shop_id] = $shop_info->shop_name;
            foreach ($shop_list as $k => $v) {
                $options[$v->shop_id] = $v->shop_name;
            }

            $this->render('update', array('user_info' => $user_info, 'options' => $options));
        }
    }

    public function actionDelete($id){
        $user_model = User::model();
        $user_info = $user_model->findByPk($id);
        $user_info->delete_flag = 0 ;
        if($user_info->save()){
            $this->redirect('index.php?r=User/index');
        }
    }

}