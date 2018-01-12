<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Hi, we are a team of Valeyo and we will help you to assemble the best computer. To do this, we created this site, which allows you to select a ready-made computer by category, or select the desired products from the available ones.</p>
    <?= Html::img('@web/images/pc.jpg', ['alt'=>'Valeo space', 'width'=>'100%']);?>
</div>
