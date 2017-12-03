<?php

namespace frontend\controllers;

use Yii;
use backend\models\Post;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionInstitutions($instId)
    {
        //всего городов в базе,относящейся к этой стране
        $page = GeoInstitutions::findOne(['id' => $instId]);

     $idModalWidget = Raits::TYPE_GEOINSTITUTIONS.$instId;//id для виджета модального окна в виде
        //обработка звездного рейтинга
        if (Yii::$app->request->isPost && Yii::$app->request->isAjax && Yii::$app->request->post('rait')){
            $rait = Yii::$app->request->post('rait');//оценка пользователя
            $res = [];
            if(!Yii::$app->user->isGuest){
                //есть ли запись о голосовании на материале у данного пользователя
                $userRaits = Raits::find()
                                ->userRaits()
                                ->andWhere(['materialType' => Raits::TYPE_GEOINSTITUTIONS,'materialId' => $instId])
                                ->count();

                //если пользователь уже голосовал выводим сообщение и далее не выполняем
                if($userRaits){
                    $res['message'] = 'Этот голос не учитывается. Вы уже проголосовали ранее...';
                    return json_encode($res, JSON_NUMERIC_CHECK);
                }

                //Если новый голос пользователя, записываем в бд
                $newRait = new Raits();
                $newRait->materialType = Raits::TYPE_GEOINSTITUTIONS;
                $newRait->materialId = $instId;
                $newRait->rateNum = $rait;
                $newRait->save();

                /**
                 * Вычисляем общий рейтинг с учетом изменений
                 */
                //выбираем все голоса по данной записи
                $allRaits = Raits::find()->where(['materialType' => Raits::TYPE_GEOINSTITUTIONS,'materialId' => $instId])
                                         ->select('rateNum');

                $allUsers = $allRaits->count();//сумма всех учетных записей пользователей к дан. материалу (1а запись - 1 пользователь)
                $sumVotes = $allRaits->sum('rateNum');//сумма всех оценок пользователей к дан. материалу

                $totalRating = round($sumVotes / $allUsers, 2);// округляем до сотых

                //записываем вычесленный рейтинг в таблицу материала в поле rating
                $inst = GeoInstitutions::findOne($instId);
                    $inst->scenario = GeoInstitutions::RATING_UPDATE;
                    $inst->rating = $totalRating;
                    $inst->ratingVotes = $allUsers;
                    $inst->save();

                //возвращаем новый рейтинг в вид
                $res['rating'] = $inst->rating;//передаем вычесленный рейтинг по материалу
                $res['ratingVotes'] = $inst->ratingVotes;//передаем сумму всех голосов по материалу

                return json_encode($res, JSON_NUMERIC_CHECK);
            }

        }

        return $this->render('institutions',[
                                                'page' => $page,
        ]);
    }

}
