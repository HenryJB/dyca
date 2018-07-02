<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use circulon\widgets\ColumnListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-lg-12">

    <!-- modal small -->
    <div class="modal fade" id="batchTagModal" tabindex="-1" role="dialog" aria-labelledby="batchTagModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel bg-danger">DCA Tag Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <form action="<?= Yii::$app->request->baseUrl ?>/students/confirm-member" method="post">


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- end modal small -->


    <p class="mt-5">
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-danger btn-lg']) ?>
        <?= Html::a('Tag Students', '#', ['id'=>'batch_tag_link','class' => 'btn btn-danger btn-lg']) ?>
    </p>

   <?php echo $this->render('_search', ['model' => $searchModel, 'tags' => $tags]); ?>



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


