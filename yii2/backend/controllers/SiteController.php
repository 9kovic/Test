<?php
namespace backend\controllers;

use common\models\Person;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller {
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(), 'rules' => [
                    ['actions' => ['login', 'error','test'], 'allow' => true,],
                    ['actions' => ['logout', 'index','test'], 'allow' => true, 'roles' => ['@'],],
                ],
            ], 'verbs' => ['class' => VerbFilter::className(), 'actions' => ['logout' => ['post'],],],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions() {
        return ['error' => ['class' => 'yii\web\ErrorAction',],];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', ['model' => $model,]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionTest() {
        echo "事件处理开始";
        $person = new Person();

        $this->on('SayHello', [$person,'say_hello'],'oh my god');

        //$this->trigger('SayHello');

        echo "事件处理结束";
    }

    public function actionTest1(){

    }

}
