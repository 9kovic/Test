<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/15
 * Time: 22:36
 */

use yii\widgets\Pjax;
use yii\helpers\Html;

?>

<?php Pjax::begin(); ?>
    <?= Html::a("更新2本书籍", ['book/get-books','num'=>2], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("更新所有本书籍", ['book/get-books','num'=>100], ['class' => 'btn btn-lg btn-primary']);?>
    <h3>当前书籍列表: </h3>
     <?php
        foreach ($models as $key=>$value){
            echo $value->book_name."<br/>";
        }

     ?>
<?php Pjax::end(); ?>




