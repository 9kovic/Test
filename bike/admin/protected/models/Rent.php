<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/6
 * Time: 15:02
 */

class Rent extends CActiveRecord{
    public $url;

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return "{{rent_info}}";
    }

    public function rules(){
        return array(
            array('bike_id,customer_id,rent_price,deposit','required','message'=>'信息必填'),

            array('customer_tel,message,customer_id_img,back_deposit','safe'),

            array('url',
                'file',    //定义为file类型
                'allowEmpty'=>true,
                'types'=>'jpg,png,gif,doc,docx,pdf,xls,xlsx,zip,rar,ppt,pptx',   //上传文件的类型
                'maxSize'=>1024*1024*10,    //上传大小限制，注意不是php.ini中的上传文件大小
                'tooLarge'=>'文件大于10M，上传失败！请上传小于10M的文件！'
            ),
        );
    }


}