<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Hi, you are on the resource of providing links to movies and TV shows.</p>
    <?= Html::img('@web/images/movie.jpg', ['alt'=>'Valeo space', 'width'=>'100%']);?>
</div>
