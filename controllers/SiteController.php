<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\JsonResponseFormatter;
use yii\web\Response;
use yii\web\User;

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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save(false);
            Yii::$app->session->addFlash('success', 'Пользователь был успешно зарегистрирован!');
            return $this->redirect(['/']);
        }

        if( $model->isNewRecord ) {
            $model->user_type = 0;
        }

        return $this->render('index', compact('model'));
    }
}