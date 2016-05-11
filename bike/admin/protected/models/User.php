<?php
/**
 * 管理员模型
 * User: Administrator
 * Date: 2015/12/31
 * Time: 16:23
 */

class User extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{user_info}}";
    }

    public function rules(){
        return array(

            array("username,password","required",'message'=>'用户名或者密码不能为空'),
            array('username', 'unique', 'message'=>'用户名已经占用'),
            array('user_info,shop_id,admin_manager_id','safe'),
        );
    }


}