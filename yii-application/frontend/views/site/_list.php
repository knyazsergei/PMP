<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="col-lg-4 card">
    <p><div class="crop"><?= Html::img('/uploads/' . $model->image, ['class' => 'centered-and-cropped']) ?></div></p>
    <h2><?= Html::encode($model->title) ?></h2>
    <p><?= \yii\helpers\StringHelper::truncate(Html::encode($model->description),120,'...');?></p>
    <p><a class="btn btn-default more" href="/post/view?id=<?= HtmlPurifier::process($model->id) ?>&catId=<?= HtmlPurifier::process($model->category) ?>">Show &raquo;</a></p>
</div>