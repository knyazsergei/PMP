<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\module\Comments;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page Content -->
<div class="container post-view">

  <!-- Portfolio Item Heading -->
  <h1 class="my-4"><?= Html::encode($this->title) ?>
    <small><?= Html::encode($this->title) ?></small>
  </h1>

  <!-- Portfolio Item Row -->
  <div class="row">

    <div class="col-md-3">
        <?= Html::img('@backendUploads/uploads/' . $model->image, ['class' => 'img-fluid', 'width' => '100%']) ?>
    </div>

    <div class="col-md-9">
      <h3 class="my-3">Controls</h3>
      <p> 
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
      <h3 class="my-3">Content</h3>

       <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'date',
        ],
      ]) ?>
    </div>

  </div>
  <!-- /.row -->

<?//https://yiigist.com/package/rmrevin/yii2-comments#!?tab=readme#%3Ftab=readme*/?>
    <?= Comments\widgets\CommentListWidget::widget([
        //'entity' => (string) 'photo-15',
        //'useRbac' => true,
        //'showCreateForm' => true
    ]);?>


</div>
    <!-- /.container -->
