<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/6
 * Time: 12:06
 */
class RentController extends Controller
{

    /**
     * 租出车辆
     */
    function  actionRentOut($id)
    {
        $add_form = new Rent();
        $user = User::model()->findByAttributes(array('username'=>Yii::app()->user->name));
        $bike_info = Ebike::model()->findByPk($id);

        if (isset($_POST['Rent'])) {

            $add_form->attributes = $_POST['Rent'];
            $add_form->customer_id_img = CUploadedFile::getInstance($add_form,'customer_id_img');

            //上传图片
            if($add_form->customer_id_img){
                $preRand = 'img_'.time().mt_rand(0,9999);
                $imgName = $preRand.'.'.$add_form->customer_id_img->extensionName;
                $add_form->customer_id_img->saveAs('uploads/'.$imgName);
                $add_form->customer_id_img = $imgName;
            }
            //拼装其他数据
            $add_form->rent_start_time = time();
            $add_form->user_id = $user->user_id;
            $add_form->shop_id = $user->shop_id;
            $add_form->bike_number = $bike_info->bike_number;
            $add_form->bike_id = $id;

            //设置车辆状态
            $bike_info->rent_flag = 1;


            //计算财务
            $money_info = Money::model()->findByAttributes(array('shop_id'=>$user->shop_id,'time'=>date('Y-m-d')));
            $money_flag = 0;
            //存在数据则修改
            if(!empty($money_info)){
                $money_update = Money::model()->findByPk($money_info->id);

                $money_in = $money_info->money_in;
                $money_update->money_in = $_POST['Rent']['rent_price']+$_POST['Rent']['deposit']+$money_in;
                if($money_update->save()){
                    $money_flag = 1;
                }

            }else{
                $money = new Money();
                $money->shop_id = $add_form->shop_id;
                $money->money_in = $_POST['Rent']['rent_price']+$_POST['Rent']['deposit'];
                $money->time = date('Y-m-d');
                $money->month = date('n');
                if($money->save()){
                    $money_flag = 1;
                }
            }




            if($add_form->validate()&&$add_form->save()&&$bike_info->save()&&$money_flag==1){


                $this->redirect('./index.php?r=Rent/RentIndex');
            }

        } else {
            $this->render('rent_out', array('bike_info' => $bike_info, 'add_form' => $add_form));
        }


    }

    /**
     * 归还车辆
     * @param $id
     */
    function actionRentBack($id)
    {
        $rent_info = Rent::model()->findByAttributes(array('bike_id'=>$id,'done_flag'=>0));
        $bike_info = Ebike::model()->findByPk($id);


        $user = User::model()->findByAttributes(array('username'=>Yii::app()->user->name));

        /**
         * 换车步骤
         * 1.重置车辆状态
         * 2.完善租车信息并设置状态
         * 3.判断还车店铺
         */

        if(isset($_POST['Rent'])){

            $rent_info->message = $_POST['Rent']['message'];
            $rent_info->back_deposit = $_POST['Rent']['back_deposit'];
            $rent_info->rent_end_time = time();
            $rent_info->back_shop_id = $user->shop_id;
            $rent_info->done_flag = 1;

            $bike_info->rent_flag = 0;
            $bike_info->shop_id = $user->shop_id;



            //还车财务计算
            $money_info = Money::model()->findByAttributes(array('shop_id'=>$user->shop_id,'time'=>date('Y-m-d')));
            $money_flag = 0;
            //存在数据则修改
            if(!empty($money_info)){
                $money_update = Money::model()->findByPk($money_info->id);

                $money_out = $money_info->money_out;
                $money_update->money_out = $money_out + $_POST['Rent']['back_deposit'];
                $money_update->money_real = $money_update->money_in - $money_update->money_out;
                if($money_update->save()){
                    $money_flag = 1;
                }

            }else{
                $money = new Money();
                $money->shop_id = $user->shop_id;
                $money->money_out = $_POST['Rent']['back_deposit'];
                $money->money_real = 0 - $_POST['Rent']['back_deposit'];
                $money->time = date('Y-m-d');
                $money->month = date('n');
                if($money->save()){
                    $money_flag = 1;
                }
            }



            if($rent_info->validate()&&$rent_info->save()&&$bike_info->save()&&$money_flag==1){
                $this->redirect('./index.php?r=Rent/RentIndex');
            }
        }

        $this->render('rent_back',array('rent_info'=>$rent_info));
    }

    /**
     * 出租管理
     */
    function actionRentIndex()
    {

        $user = User::model()->findByAttributes(array('username' => Yii::app()->user->name));

        $bike_list = Ebike::model()->findAllByAttributes(array('shop_id' => $user->shop_id,'rent_flag'=>0,'delete_flag'=>1));

        //查询未完成租车信息
        $rent_list = array();
        $user_ids = User::model()->findAllBySql('select user_id from {{user_info}} WHERE admin_manager_id = '.$user->admin_manager_id);
        foreach($user_ids as $k=>$v){
            $rent_info = Rent::model()->findAllByAttributes(array('user_id'=>$v->user_id,'done_flag'=>0));
            if(!empty($rent_info)){
                foreach($rent_info as $v){
                    $rent_list[] = $v;
                }
            }
        }

        $this->render('rent_index', array('bike_list' => $bike_list,'rent_list'=>$rent_list));
    }


}