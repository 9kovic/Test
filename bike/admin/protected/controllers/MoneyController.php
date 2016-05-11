<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/13
 * Time: 9:43
 */
class MoneyController extends Controller
{

    public function actionIndex()
    {

        $user = Admin::model()->findByAttributes(array('username' => Yii::app()->user->name));

        //查询当前用户的完成的租车订单情况
        $sql = "select r.bike_id,r.bike_number,r.rent_start_time,r.shop_id,r.rent_end_time,s.shop_name,r.back_deposit,r.deposit,r.rent_price,r.back_shop_id from k_shop AS s,k_bike_info AS b, k_rent_info as r WHERE s.shop_id = b.shop_id AND r.bike_id = b.bike_id and s.admin_manager_id = " . $user->admin_id . " AND b.delete_flag = 1 and r.done_flag = 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rent_infos = $command->queryAll();


        for ($i = 0; $i < sizeof($rent_infos); $i++) {
            $rent_infos[$i]['rent_start_time'] = date("Y-m-d H:i:s", $rent_infos[$i]['rent_start_time']);
            $rent_infos[$i]['rent_end_time'] = date("Y-m-d H:i:s", $rent_infos[$i]['rent_end_time']);
        }



        //计算每一家店铺的营业额
        $sql2 = "SELECT k_money.shop_id,SUM(k_money.money_real) as sum_money,k_shop.shop_name from k_money,k_shop WHERE k_money.shop_id = k_shop.shop_id AND k_shop.admin_manager_id = ".$user->admin_id." GROUP BY shop_id";
        $shops_each = $connection->createCommand($sql2)->queryAll();

        //店铺和实际收入
        $shop_names = array();
        $shop_reals = array();
        foreach($shops_each as $v){
            $shop_names[] = $v['shop_name'];
            $shop_reals[] = $v['sum_money'];
        }


        //按照月查询所有营业额
        $sql3 = "SELECT k_money.month,SUM(k_money.money_real) as sum_money from k_money,k_shop WHERE k_money.shop_id = k_shop.shop_id AND k_shop.admin_manager_id = ".$user->admin_id." GROUP BY k_money.month";
        $shops_sum = $connection->createCommand($sql3)->queryAll();

        $months = array();
        $month_real = array();
        foreach($shops_sum as $v){
            $months[] = $v['month']."月份";
            $month_real[] = $v['sum_money'];
        }

        //计算监控信息
        $sql4 = "select * from k_warning_bike as w,k_shop as s,k_bike_info as b WHERE w.shop_id = s.shop_id AND w.gps_number = b.gps_number";
        $warning_list = $connection->createCommand($sql4)->queryAll();



        $rent_infos = json_encode($rent_infos);

        $shop_names = json_encode($shop_names);
        $shop_reals = json_encode($shop_reals);

        $months = json_encode($months);
        $month_real = json_encode($month_real);

        $warning_list = json_encode($warning_list);


        $this->render('index', array('rent_infos' => $rent_infos,'shop_names'=>$shop_names,'shop_reals'=>$shop_reals,'months'=>$months,'month_real'=>$month_real,'warning_list'=>$warning_list));


    }


}