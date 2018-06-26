<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use circulon\widgets\ColumnListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">
   <?php echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<div class="student-index">




    <?php
    Pjax::begin(['id' => 'my-list-view']);

      echo ColumnListView::widget([
          'dataProvider' => $dataProvider,
          'columns' => 3,
          'itemOptions' => [
            'class' => 'col-md-4 offset-md-2 col-sm-4 offset-sm-2 col-lg-4 offset-lg-2 col-xl-3 offset-xl-2 col-xs-6 offset-xs-3',
          ],
          'itemView'     => '_student',

        ]);
  Pjax::end();




    ?>



</div>
