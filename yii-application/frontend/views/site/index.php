<?php
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'Valeo space';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">Choose the best assembly!</p>

        <p><a class="btn btn-lg btn-success" href="/post/">Let's start</a></p>
    </div>

    <div class="album text-muted">
        <div class="container-fluid">

            <div class="row">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list',
                    'summary' => '',
                    'layout' => '{items}'
                ]); ?>
            </div>
        </div>
    </div>
</div>
