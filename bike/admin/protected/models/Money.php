<?php
/**
 * 财务模型
 * User: Administrator
 * Date: 2015/12/31
 * Time: 16:23
 */

class Money extends CActiveRecord{
    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{money}}";
    }

    public function rules(){
        return array(
        );
    }

}