<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Assembly', $this->title);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
     <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'summary' => '',
         'layout' => "{summary}\n{items}\n<center class='clear'>{pager}</center>",
         'pager' => ['maxButtonCount' => 5],
    ]); ?>

</div>
