<?php

namespace frontend\controllers;
 
use common\models\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
 
class ProfileController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
 
    public function actionIndex()
    {
        $model = $this->findModel();

        if($model->load(Yii::$app->request->post())) {
            if($model["newPassword"] == $model["newPasswordRepeat"]) {
                $model->setPassword($model["newPassword"]);
                $model->update();
            }
        }

        return $this->render('index', [
            'model' => $this->findModel()
        ]);
    }
 
    /**
     * @return User the loaded model
     */
    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }
}