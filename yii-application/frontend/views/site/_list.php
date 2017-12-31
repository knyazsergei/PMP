<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
 
<div class="col-lg-4">
    <h2><?= Html::encode($model->title) ?></h2>    
    <p><?= HtmlPurifier::process($model->description) ?></p>
    <p><div class="crop"><?= Html::img('@backendUploads/uploads/' . $model->image, ['class' => 'centered-and-cropped']) ?></div></p>
    <p><a class="btn btn-default" href="/index.php?r=post%2Fview&id=<?= HtmlPurifier::process($model->id) ?>">Show &raquo;</a></p>
</div>