<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <details>
        <summary>Search</summary>
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </details>
     <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
        'summary' => '',
        'layout' => '{items}'
    ]); ?>

</div>
