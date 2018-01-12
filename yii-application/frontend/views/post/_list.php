<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="col-lg-4 col-sm-6 portfolio-item">
  <div class="card h-100">
    <a href="#"><img class="card-img-top centered-and-cropped" width="100%" src="<?= (empty($model->image) ? "/images/nophoto.png" : Yii::getAlias('/uploads/' . HtmlPurifier::process($model->image))) ?>" alt=""></a>
    <div class="card-body">
      <h4 class="card-title"><?= Html::encode($model->title) ?></h4>
        <p class="card-text"><?= \yii\helpers\StringHelper::truncate(Html::encode($model->description),120,'...');?></p>
        <p><a class="btn btn-default more" href="/post/view?id=<?= HtmlPurifier::process($model->id) ?>&catId=<?= HtmlPurifier::process($model->category) ?>">Show &raquo;</a></p>

    </div>
  </div>
</div>
