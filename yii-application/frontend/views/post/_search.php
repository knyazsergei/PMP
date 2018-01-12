<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<?php /*
<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'category') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

*/?>
<div class="post-search">
    <div class="jumbotron">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => [
                'class' => ''
            ],
            'fieldConfig' => [
                'template' => '{input}',
            ]
        ]);?>
        <?= $form->field($model, 'title', ['inputOptions' => ['autofocus' => 'autofocus', 'placeholder' => 'Enter here any key words', 'class' => 'form-control']]); ?></li>
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>

        <?php
        ActiveForm::end();
        ?>
    </div>


</div>