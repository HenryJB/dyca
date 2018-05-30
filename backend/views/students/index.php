<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <p>

    </p>
    <?php
    $columns = 3;
    $cl = 12 / $columns;

echo ListView::widget([
      'dataProvider' => $dataProvider,
      'layout'       => '{items}{pager}',
      'itemOptions'  => ['class' => "col-md-$cl"],
      'itemView'     => '_student',
      'options'      => ['class' => '' ],
      'beforeItem'   => function ($model, $key, $index, $widget) use ($columns) {
          if ($index % $columns == 0 ) {
              return "<div class='row'>";
          }
      },

      'afterItem' => function ($model, $key, $index, $widget) use ($columns) {
          if ( $index != 0 && $index % ($columns - 1) == 0 ) {
              return "</div>";
          }
      }
]);




    ?>



</div>
