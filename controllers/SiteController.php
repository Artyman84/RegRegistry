<?php

namespace app\controllers;

use app\models\Users;
use SebastianBergmann\Diff\TimeEfficientImplementationTest;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Users;
        $attributes = Yii::$app->request->post();

        if( isset($attributes['Users']) ) {

            if( !$attributes['Users']['user_type'] ) {
                $attributes['Users']['company'] = null;
            }

            if ($model->load($attributes) && $model->validate()) {
                $model->save(false);
                Yii::$app->session->addFlash('success', 'Пользователь был успешно зарегистрирован!');
                return $this->redirect(['/']);
            }
        }

        if( $model->isNewRecord ) {
            $model->user_type = 0;
        }

        return $this->render('index', compact('model'));
    }
}
