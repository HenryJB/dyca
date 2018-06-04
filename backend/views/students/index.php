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
<div class="student-index">

<div class="col-lg-12">
   <?php /* echo $this->render('_search', ['model' => $searchModel]); */?>
</div>


    <?php
    Pjax::begin(['id' => 'my-list-view']);

      echo ColumnListView::widget([
          'dataProvider' => $dataProvider,
          'columns' => 3,
          'itemOptions' => [
            'class' => 'col-lg-4 col-xs-12',
          ],
          'itemView'     => '_student',

        ]);
  Pjax::end();




    ?>



</div>
