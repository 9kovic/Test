<?php

/**
 * 全景控制器
 * User: Administrator
 * Date: 2016/1/7
 * Time: 10:29
 */
class TrackController extends Controller
{

    /**
     * 展示所有车轨迹
     */
    public function actionIndex()
    {


        $admin_model = new Admin();

        $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));

        if (empty($user)) {
            Yii::error('您没有权限查看此项', './index.php?r=Index/Index', 3);
            exit;
        }


        //查询当前用户旗下的车辆
        $sql = "select k_bike_info.gps_number from k_shop,k_bike_info where k_shop.shop_id = k_bike_info.shop_id and k_shop.admin_manager_id = " . $user->admin_id . " and k_bike_info.delete_flag =1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $ebike_list = $command->queryAll();


        //查询当前用户旗下的店铺
        $sql = "SELECT s.shop_name,s.shop_id,s.shop_jwd from k_admin as a,k_shop s WHERE s.admin_manager_id = a.admin_id and a.username = '" . $user->username . "'" . " and s.delete_flag =1";
        $shop_list = $connection->createCommand($sql)->queryAll();

        //位置信息列表
        $location_list = array();
        //拼装结果集
        foreach ($ebike_list as $k => $v) {

            if (!empty($connection->createCommand("select * from k_bike_track as tk WHERE tk.bike_id =  " . $v['gps_number'] . " order by tk.time desc limit 1")->queryAll()[0])) {
                $location_list[] = $connection->createCommand("select * from k_bike_track as tk WHERE tk.bike_id =  " . $v['gps_number'] . " order by tk.time desc limit 1")->queryAll()[0];
            }


        }

        //json格式的位置信息
        $location_json = array();

        foreach($location_list as $v){
            $temp['title'] = '车辆 ID';
            $temp['content'] = $v['bike_id'];
            $temp['point'] = $v['jd']."|".$v['wd'];
            $temp['isOpen'] = 0;
            $temp['icon'] = array('w'=>23,'h'=>25,'l'=>69,'t'=>21,'x'=>9,'lb'=>12);
            $location_json[] = $temp;
        }
        $location_json = json_encode($location_json);

        //json格式的商店位置信息
        $shop_json = array();
        foreach($shop_list as $v){
            $arr = explode(',',$v['shop_jwd']);
            $temp['name'] = $v['shop_name'];
            $temp['jingdu'] = $arr[0];
            $temp['weidu'] = $arr[1];
            $temp['shop_id'] = $v['shop_id'];
            $shop_json[] = $temp;
        }

        $shop_json = json_encode($shop_json);

        $this->render('index', array('location_json'=>$location_json,'shop_json'=>$shop_json));
    }


    public function actionSearch()
    {
        if(Yii::app()->request->isAjaxRequest){
            $id = Yii::app()->request->getParam('shop_id');
            $admin_model = new Admin();
            $user = $admin_model->findByAttributes(array('username' => Yii::app()->user->name));
            $connection = Yii::app()->db;
            //位置信息列表
            $location_list = array();
            //查询当前商店的车辆
            $sql = "SELECT k_bike_info.gps_number from k_shop,k_bike_info WHERE k_bike_info.shop_id = k_shop.shop_id and k_shop.shop_id = $id AND k_bike_info.delete_flag = 1";
            $command = $connection->createCommand($sql);
            $ebike_list = $command->queryAll();


            foreach ($ebike_list as $k => $v) {
                if (!empty($connection->createCommand("select * from k_bike_track as tk WHERE tk.bike_id =  " . $v['gps_number'] . " order by tk.time desc limit 1")->queryAll()[0])) {
                    $location_list[] = $connection->createCommand("select * from k_bike_track as tk WHERE tk.bike_id =  " . $v['gps_number'] . " order by tk.time desc limit 1")->queryAll()[0];
                }

            }

            //json格式的位置信息
            $location_json = array();
            foreach($location_list as $v){
                $temp['title'] = '车辆 ID';
                $temp['content'] = $v['bike_id'];
                $temp['point'] = $v['jd']."|".$v['wd'];
                $temp['isOpen'] = 0;
                $temp['icon'] = array('w'=>23,'h'=>25,'l'=>69,'t'=>21,'x'=>9,'lb'=>12);
                $location_json[] = $temp;
            }



            //查询指定商店
            $sql = 'select * from k_shop where k_shop.shop_id = ' . $id . " and k_shop.delete_flag = 1";
            $shop_info = $connection->createCommand($sql)->queryAll()[0];


            $shop_json = array();
            $arr = explode(',',$shop_info['shop_jwd']);
            $temp['name'] = $shop_info['shop_name'];
            $temp['jingdu'] = $arr[0];
            $temp['weidu'] = $arr[1];
            $temp['shop_id'] = $shop_info['shop_id'];
            $shop_json[] = $temp;



            $rs['shop'] = $shop_json;
            $rs['bike'] = $location_json;


            echo json_encode($rs);
        }








    }


}