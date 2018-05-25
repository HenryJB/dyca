<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'gender',
            'email_address:email',
            //'contact_address:ntext',
            //'occupation',
            //'photo',
            //'facebook_id',
            //'twitter_handle',
            //'instagram_handle',
            //'year',
            //'payment_status',
            //'approval_status',
            //'country',
            //'state_id',
            //'date_of_birth',
            //'first_choice',
            //'second_choice',
            //'reason:ntext',
            //'propose_project:ntext',
            //'information_source',
            //'sponsor_aid',
            //'sponsorship_status',
            //'is_existing',
            //'terms_condition',
            //'date_registered',
            //'emergency_fullname',
            //'emergency_relationship',
            //'emergency_phone_number',
            //'emergency_secondary_phone_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
