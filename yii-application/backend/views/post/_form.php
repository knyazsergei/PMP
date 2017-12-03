<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    
	<?= $form->field($model, 'date')->widget(\kartik\datetime\DateTimePicker::className(), [
		    'name' => 'date',
		    'type' => DateTimePicker::TYPE_INPUT,
    		'value' => '2017-11-01',
    		'removeButton' => false,
  		    'convertFormat' => true,
    		'pluginOptions' => [
    			'minView' =>3,
    			
    		    'autoclose'=>true,
    		    'format' => 'yyyy-M-dd'
    		]
		]);
	?>

	<?= $form->field($model, 'image')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
