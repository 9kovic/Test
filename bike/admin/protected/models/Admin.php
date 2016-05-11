<?php
/**
 * 管理员模型
 * User: Administrator
 * Date: 2015/12/31
 * Time: 16:23
 */

class Admin extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{admin}}";
    }

    public function rules(){
        return array(

            array("username,password","required",'message'=>'用户名或者密码不能为空'),
            array('username', 'unique', 'message'=>'用户名已经占用'),
            //验证确认密码password2  要与密码的信息一致
            array('password2','compare','compareAttribute'=>'password','message'=>'两次密码必须一致'),
            //邮箱默认不能为空
            array('email','email','allowEmpty'=>false,  'message'=>'邮箱格式不正确'),
        );
    }

    public $password2;
}