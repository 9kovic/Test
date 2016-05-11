<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/7
 * Time: 10:51
 */


class Track extends CActiveRecord{

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{bike_track}}";
    }


}