<?php
/**
 * 商店模型
 * User: Administrator
 * Date: 2016/1/4
 * Time: 17:05
 */
class Shop extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{shop}}";
    }

    public function rules(){
        return array(
            array('shop_name','required','message'=>'店铺名称不能为空'),
            array('shop_address','required','message'=>'店铺地址不能为空'),
            array('shop_jwd','required','message'=>'店铺位置不能为空'),
            array('admin_manager_id','safe'),
            array('shop_info','safe'),

        );
    }


}