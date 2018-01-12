<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'My profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">

  <h1><?= Html::encode($this->title) ?></h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="<?=$model->getAvatar()?>" class="avatar img-circle img-thumbnail" alt="avatar">
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <?php
      /*
      <div class="alert alert-info alert-dismissable">
        <a class="panel-close close" data-dismiss="alert">×</a> 
        <i class="fa fa-coffee"></i>
        This is an <strong>.alert</strong>. Use this to show important messages to the user.
      </div>
      */
      ?>
      <h3>Personal info</h3>
        <?php $form = ActiveForm::begin([
                'options' => [
                        'class' => 'form-horizontal'
                ],
                'fieldConfig' => [
                    'template' => '{label}<div class="col-lg-8">{input}</div>',
                    'labelOptions' => ['class' => 'col-md-3 control-label'],
                ]
            ]
        ); ?>
        <div class="form-group">
          <label class="col-lg-3 control-label">User name:</label>
          <div class="col-lg-8">
            <input class="form-control" value="<?=$model['username']?>" disabled type="text">
          </div>
        </div>

        <?= $form->field($model, 'email')->input('email')->label(true) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true])->label("Confirm password") ?>

        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
              <?= Html::submitButton('Save Changes', ['class' => 'btn btn-primary']) ?>
          </div>
        </div>
        <?php ActiveForm::end(); ?>

  </div>
</div>	

</div>