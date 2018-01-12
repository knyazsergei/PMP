<?php

namespace frontend\controllers;

use Yii;
use backend\models\Post;
use backend\models\UploadImage;
use backend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\Pagination;
use yii\data\ArrayDataProvider;
use frontend\controllers\AssemblyController;


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

    public function actionCategory($catId)
    {
        if(isset($catId)) {
            $searchModel = new PostSearch();
            $searchModel->category = $catId;
            $dataProvider = $searchModel->search(['category' => $catId]);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        } else {
            actionIndex();
        }
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can('updatePost')) {
            return $this->redirect(['index']);
        }
        $model = new Post();
        $uploadImageModel = new UploadImage();

        if ($model->load(Yii::$app->request->post())) {

            $uploadImageModel->image = UploadedFile::getInstance($model, 'image');
            $model->image = "";
            $model->author_id = Yii::$app->user->id;
            if($model->save()) {

               if($model->image = $uploadImageModel->upload($model->id)) {
                   $model->save();
               }
                return $this->redirect(['view', 'id' => $model->id, 'image' => $uploadImageModel->image]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'uploadImageModel' => $uploadImageModel
        ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (!(Yii::$app->user->can('updatePost') && Yii::$app->user->id ==  $this->findModel($id)->author_id)) {
            return $this->redirect(['index']);
        }
        $model = $this->findModel($id);
        $uploadImageModel = new UploadImage();

        if ($model->load(Yii::$app->request->post())){
            $uploadImageModel->image = UploadedFile::getInstance($model, 'image');

            $model->image = $uploadImageModel->upload($model->id);

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (!(Yii::$app->user->can('updatePost') && Yii::$app->user->id == $this->findModel($id)->author_id)) {
            return $this->redirect(['index']);
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

}
