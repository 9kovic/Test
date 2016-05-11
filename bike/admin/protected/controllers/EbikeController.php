<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/5
 * Time: 15:20
 */
class EbikeController extends Controller
{

    /**
     * 展示车辆
     */
    function actionIndex()
    {
        $admin_model = new Admin();


        $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));

        if(empty($user)){
            Yii::error('您没有权限查看此项','./index.php?r=Index/Index',3);
            exit;
        }


        //查询当前用户旗下的车辆
        $sql = "select * from k_shop,k_bike_info where k_shop.shop_id = k_bike_info.shop_id and k_shop.admin_manager_id = " . $user->admin_id . " and k_bike_info.delete_flag =1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $ebike_list = $command->queryAll();


        foreach($ebike_list as $k=>$v){
            $id = $ebike_list[$k]['bike_id'];
            $ebike_list[$k]['bike_id'] = "<a href=\"./index.php?r=Ebike/Update&bike_id=$id\">编辑</a>"."/"."<a href=\"./index.php?r=Ebike/Delete&id=$id\">删除</a>";
        }

        $ebike_list = json_encode($ebike_list);


        $this->render('index', array('ebike_list' => $ebike_list));
    }

    /**
     * 添加车辆
     */
    function actionAdd()
    {

        $add_form = new Ebike();

        $admin_model = Admin::model();
        $shop_model = Shop::model();


        if (isset($_POST['Ebike'])) {
            $add_form->attributes = $_POST['Ebike'];

            if ($add_form->validate()) {
                if ($add_form->save()) {

                    $this->redirect('./index.php?r=Ebike/index');
                }

            }
        } else {
            $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));
            if (!empty($user)) {
                $options = array();
                $sql = "select shop_id,shop_name from {{shop}} WHERE delete_flag = 1 and admin_manager_id = " . $user->admin_id;
                $shop_list = $shop_model->findAllBySql($sql);
                foreach ($shop_list as $k => $v) {
                    $options[$v->shop_id] = $v->shop_name;
                }
                $this->render('add', array('add_form' => $add_form, 'options' => $options));
            }
        }

    }

    /**
     * 更新车辆信息
     * @param $bike_id
     */
    public function actionUpdate($bike_id)
    {

        $ebike_model = Ebike::model();
        $admin_model = Admin::model();
        $shop_model = Shop::model();

        if (isset($_POST['Ebike'])) {
            $ebike_model = $ebike_model->findByPk($bike_id);
            $ebike_model->attributes = $_POST['Ebike'];

            if ($ebike_model->validate()) {
                if ($ebike_model->save()) {
                    $this->redirect('./index.php?r=Ebike/index');
                }

            }
        } else {

            $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));
            $ebike_info = $ebike_model->findByPk($bike_id);
            if (!empty($user)) {
                $options = array();
                $sql = "select shop_id,shop_name from {{shop}} WHERE delete_flag = 1 and admin_manager_id = " . $user->admin_id;
                $shop_list = $shop_model->findAllBySql($sql);
                foreach ($shop_list as $k => $v) {
                    $options[$v->shop_id] = $v->shop_name;
                }

                $this->render('update', array('ebike_info' => $ebike_info, 'options' => $options));
            }
        }


    }

    /**
     * 删除车辆
     * @param $bike_id
     */
    public function actionDelete($bike_id)
    {
        $ebike_model = Ebike::model();

        $ebike_info = $ebike_model->findByPk($bike_id);

        if (!empty($ebike_info)) {
            $ebike_info->delete_flag = 0;
            if ($ebike_info->save()) {
                $this->redirect('./index.php?r=Ebike/index');
            }
        }

    }


}