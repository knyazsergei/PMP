<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $searchModel backend\models\PostSearch */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Pjax;


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
        ['label' => 'Assembly', 'url' => ['/post/index']],
        ['label' => 'OS X', 'url' => 'https://www.tonymacx86.com/buyersguide/january/2018/'],
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
                        <li><a href="/profile/" tabindex="-1">Profile</a></li>
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
            <p>
            <a class="btn btn-primary btn-lg btn-block" href="/post/create">Add my assembly</a>
            </p>
          <div class="list-group">
              <a href="/" class="list-group-item">Home page</a>
              <a href="/post/" class="list-group-item">All assembly</a>
              <?php
              $result=parse_url($_SERVER['REQUEST_URI']);
              if(isset($result['query'])) {
                  parse_str($result['query'], $params);
              }
              $catList = Yii::$app->getModule('categories')->getAll();
                $i = 0;
                foreach ($catList as $cat) {
                    $active = "";
                    if(isset($params['catId']) && $params['catId']== $i) {
                        $active = " active";
                    }
                    echo " <a href=\"/post/category?catId=" . $i++ . "\" class=\"list-group-item" . $active . "\">" . $cat["name"] . "</a>";
                }
                //can be class = "active"
              ?>
          </div>
        </div><!--/span-->

            <?php Pjax::begin(); ?>
        <div class="col-12 col-md-9">
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>

          <?= $content ?>
        </div><!--/span-->
            <?php Pjax::end(); ?>

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
