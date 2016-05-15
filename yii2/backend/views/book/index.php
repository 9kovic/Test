<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchBook */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <?php Pjax::begin(); ?>
    <?= Html::a("更新时间", ['book/index'], ['class' => 'btn btn-lg btn-primary']);?>
    <h3>当前时间: <?= $time ?></h3>

    <?php Pjax::end(); ?>
    
    
    
    
    

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加图书', ['create'], ['class' => 'btn btn-success']) ?>
    </p>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'book_name',
            'book_price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
