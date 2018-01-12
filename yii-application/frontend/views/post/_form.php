<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
     $catList = Yii::$app->getModule('categories')->getAll();
     $normilizeCatList = [];
     foreach ($catList as $cat) {
         $normilizeCatList[] = $cat["name"];
     }

    $params = [
        'prompt' => 'Choose category...'
    ];
    echo $form->field($model, 'category')->dropDownList($normilizeCatList,$params);?>

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



    <?= $form->field($model, 'CPU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MotherBoard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ComputerCase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VideoCard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CoolingSystem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RAM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ROM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PowerSupply')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AudioCard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Price')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
