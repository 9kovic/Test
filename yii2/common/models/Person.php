<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/14
 * Time: 18:17
 */
namespace common\models;

use yii\base\Model;

class Person extends Model{
    public function say_hello($param){
        echo "Person model say ".$param->data;
    }
}