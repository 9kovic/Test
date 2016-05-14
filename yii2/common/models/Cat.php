<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/14
 * Time: 21:22
 */
namespace common\models;

use yii\base\Component;

class Cat extends Component{

    const EVENT_NEW_CAT = 'new-cat';

    public function sendFood($event){
        echo "foot send to the cat"."<br/>";

    }

    public function getCatName($event){
        
        echo "The cat name is ".$event->data."<br/>";

    }

    public  function haveCat($name){
        $this->on(self::EVENT_NEW_CAT, [$this, 'sendFood']);
        $this->on(self::EVENT_NEW_CAT, [$this, 'getCatName'],$name);
    }


}