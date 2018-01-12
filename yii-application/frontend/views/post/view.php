<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\module\Comments;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Assembly'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', Yii::$app->getModule('categories')->getAll()[$model['category']]['name']), 'url' => ['post/category?catId=' . $model['category']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container-fluid post-view">

    <div class="row">
        <div class="col-md-9">
            <h1 class="my-3"><?= Html::encode($this->title) ?>
              <small><?= Html::encode($this->title) ?></small>
            </h1>
        </div>

        <div class="col-md-3">
            <div class="form-group pull-right" style="margin-top:20px">
                <input type="text" class="searchKey form-control" placeholder="Search part">
            </div>
        </div>
    </div>

  <div class="row">

    <div class="col-md-3">
        <?php
            if(empty($model->image)) {
                echo Html::img("/images/nophoto.png", ['class' => 'centered-and-cropped']);
            } else {
               echo Html::img('/uploads/' . $model->image, ['class' => 'centered-and-cropped']);
            }
        ?>

        <div class="center-block row">
            <div class="text-center "><h3>Price: <?=$model['Price']?>$</h3></div>
        </div>

        <p class="text-center">
            <?php
            if (Yii::$app->user->can('updatePost') && Yii::$app->user->id == $model->author_id) {
             echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
             echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]); }?>
        </p>

    </div>
    <div class="col-md-9">
        <p><?=$model->description?></p>
       <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CPU',
            'MotherBoard',
            'ComputerCase',
            'VideoCard',
            'CoolingSystem',
            'RAM',
            'ROM',
            'PowerSupply',
            'AudioCard',
        ],
           'options' => [
               'class' => 'table table-hover table-bordered results',
           ]
      ]) ?>
    </div>
      <script>
          function createExpr(arr) {
              var index = 0;
              var expr = [":containsiAND('" + arr[0] + "')"];
              for (var i = 1; i < arr.length; i++) {
                  if (arr[i] === 'AND') {
                      expr[index] += ":containsiAND('" + arr[i + 1] + "')";
                      i++;
                  } else if (arr[i] === 'OR') {
                      index++;
                      expr[index] = ":containsiOR('" + arr[i + 1] + "')";
                      i++;
                  }
              }
              return expr;
          }
          $(document).ready(function() {

              $(".searchKey").keyup(function() {
                  var searchTerm = $(".searchKey").val().replace(/["']/g, "");
                  var arr = searchTerm.split(/(AND|OR)/);
                  var exprs = createExpr(arr);
                  var searchSplit = searchTerm.replace(/AND/g, "'):containsiAND('").replace(/OR/g, "'):containsiOR('");

                  $.extend($.expr[':'], {
                      'containsiAND': function(element, i, match, array) {
                          return (element.textContent || element.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                      }
                  });

                  $('.results tbody tr').addClass('hidden');
                  for (var expr in exprs) {
                      $(".results tbody tr" + exprs[expr]).each(function(e) {
                          $(this).removeClass('hidden');
                      });
                  }

                  var searchCount = $('.results tbody tr[visible="true"]').length;

                  $('.searchCount').text('founded ' + searchCount + ' results');
                  if (searchCount == '0') {
                      $('.no-result').show();
                  } else {
                      $('.no-result').hide();
                  }
                  if ($('.searchKey').val().length == 0) {
                      $('.searchCount').hide();
                  } else {
                      $('.searchCount').show();
                  }
              });
          });
      </script>
  </div>
  <!-- /.row -->
<hr />
<?//https://yiigist.com/package/rmrevin/yii2-comments#!?tab=readme#%3Ftab=readme*/?>
    <?= Comments\widgets\CommentListWidget::widget([
        'entity' => 'photo-15',
        //'useRbac' => true,
        'showCreateForm' => true
    ]);?>


</div>
    <!-- /.container -->
