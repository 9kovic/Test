<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/5
 * Time: 15:58
 */

class Ebike extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{bike_info}}";
    }

    public function rules(){
        return array(

            array("bike_number","required",'message'=>'车辆id不能为空'),
            array("gps_number","required",'message'=>'gps号不能为空'),
            array('bike_info,shop_id,bike_id,delete_flag,sim_number','safe'),
        );
    }

}