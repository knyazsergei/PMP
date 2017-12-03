<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use kartik\rating\StarRating;
?>

<div class="col-lg-4 col-sm-6 portfolio-item">
  <div class="card h-100">
    <a href="#"><img class="card-img-top" width="100%" src="<?= Yii::getAlias('@backendUploads/uploads/');?><?= HtmlPurifier::process($model->image) ?>" alt=""></a>
    <div class="card-body">
      <h4 class="card-title">
        <a href="/index.php?r=post%2Fview&id=<?= HtmlPurifier::process($model->id) ?>"><?= Html::encode($model->title) ?></a>
      </h4>
      <p class="card-text"><?= Html::encode($model->description) ?>
      <?php
			echo StarRating::widget([
		    'name' => 'rating_20',
		    'pluginOptions' => [
		        'size' => 'md',
		        'stars' => 5,
		        'step' => 1,
		        'showClear' => false,
		        'showCaption' => false,
		        'animate' => false,
				'disabled' => Yii::$app->user->isGuest ? true : false,//для гостя блокируем кнопки

		    ]
		]);
		?>
    </div>
  </div>
</div>
