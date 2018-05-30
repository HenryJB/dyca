<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = "Registration Prompt";
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="container">

        <div class="my-4">
            <section class="card wow fadeIn" style="background-image: url(&quot;https://mdbootstrap.com/img/Photos/Others/gradient1.jpg&quot;); visibility: visible; animation-name: fadeIn;">

                <!-- Content -->
                <div class="card-body text-white text-center py-5 px-5 my-5">

                    <h1 class="mb-4">
                        <strong>Please Proceed To Payment page by clicking the link below</strong>
                    </h1>
                    <p>
                        <strong>DCA &amp; Changing the narrative</strong>
                    </p>

                    <a target="_blank" href="https://mdbootstrap.com/bootstrap-tutorial/" class="btn btn-outline-white btn-lg waves-effect waves-light">Pay
                        <i class="fa fa-money-bill-alt ml-2"></i>
                    </a>

                </div>
                <!-- Content -->
            </section>
        </div>

    </div>