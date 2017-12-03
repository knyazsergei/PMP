<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Valeo space',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Posts', 'url' => ['/post/index']],
        ['label' => 'Contact', 'url' => ['/site/contact']]
   ];
    
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '
            <li class="dropdown">
                <a class="dropdown-toggle" href="#" data-toggle="dropdown">' . Yii::$app->user->identity->username . '<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" tabindex="-1">Profile</a></li>
                        <li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout',
                            ['class' => 'btn-as-link']
                        )
                        . Html::endForm()
                        . '</li>
                    </ul>
            </li>';

    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <main role="main" class="container">

      <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-6 col-md-3 sidebar-offcanvas">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
        </div><!--/span-->

        <div class="col-12 col-md-9">
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
          <?= Alert::widget() ?>

          <?= $content ?>
        </div><!--/span-->


      </div><!--/row-->

      <hr>

    </main><!--/.container-->

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Valeo space <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
