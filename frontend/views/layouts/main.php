
<?php
/* @var $this \yii\web\View */
/* @var $content string */
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Alert;
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
    <style type="text/css">
      .content{padding-top:80px; padding-bottom:80px;}
.mb40{margin-bottom:40px;}
.team-block { margin-bottom: 20px; }
.team-content { position: absolute; background-color: rgba(17, 24, 31, 0.8); bottom: 0px; display: inline-block; width: 100%; color: #fff; padding: 30px; }
.team-img { position: relative; }
.team-img img { width: 100%; }
.team-title { }
.team-meta { color: #9da4aa; font-weight: 400; font-size: 16px; }
.overlay { border-radius: 0px; position: absolute; top: 0; bottom: 0; left: 0; right: 0; height: 100%; width: 100%; opacity: 0; transition: 1s ease; background-color: #11181f; }
.team-img:hover .overlay { opacity: .8; }
.team-img:hover .team-content { opacity: 0; }
.text { color: #fff; position: absolute; top: 30%; left: 30%; transform: translate(-26%, -26%); -ms-transform: translate(-26%, -26%); right: 0; font-weight: 400; font-size: 16px; }
    </style>
</head>
<body>
  <!-- Modal -->
  <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">

              </div>

          </div>
      </div>
  </div>
  <!-- Modal -->
  <!-- =====================================
  ==== Start Loading -->
  <div class="loading">
      <div class="text-center middle">
          <div class="lds-ellipsis">
              <div></div>
              <div></div>
              <div></div>
              <div></div>
          </div>
      </div>
  </div>
  <!-- End Loading ====
  ======================================= -->

<?php $this->beginBody(); ?>

<!-- =====================================
==== Start Navbar -->

<nav class="navbar navbar-dark navbar-expand-lg  justify-content-between">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse dual-nav w-100">
        <ul class="navbar-nav">
            <li class="nav-item">

                    <?=Html::a('HOME', Yii::$app->request->baseUrl.'/site/home', ['class' => 'nav-link pl-0']); ?>

            </li>

            <li class="nav-item">

                    <?=Html::a('About', Yii::$app->request->baseUrl.'/site/about', ['class' => 'nav-link pl-0']); ?>

            </li>
            <li class="nav-item">

                  <?=Html::a('COURSES', Yii::$app->request->baseUrl.'/courses/index', ['class' => 'nav-link']); ?>
            </li>
            <li class="nav-item">
              <?=Html::a('ALUMNI', Yii::$app->request->baseUrl.'/alumni/index', ['class' => 'nav-link']); ?>

            </li>
            <li class="nav-item">

                  <?=Html::a('INSTRUCTORS', Yii::$app->request->baseUrl.'/instructors/index', ['class' => 'nav-link']); ?>
            </li>

        </ul>
    </div>
    <a href="<?=Yii::$app->request->baseUrl?>/site/index" class="navbar-brand mx-auto d-block text-cente">
        <img src="<?= Url::to('@web/img/dcalogo.png'); ?>" id="img-brand" width="80px" height="50px">
    </a>
    <div class="navbar-collapse collapse dual-nav w-100">
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item" id="apply_now">
              <?=Html::a('APPLY NOW', Yii::$app->request->baseUrl.'/students/create', ['class' => 'btn btn-outline-white  btn-danger']); ?>

            </li>
            <li class="nav-item" id="login">
                <?=Html::a('LOGIN', Yii::$app->request->baseUrl.'/site/login', ['class' => 'btn btn-outline-white text-white']); ?>

            </li>
            <!-- <li class="nav-item">
                <a class="btn  text-white" href="">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="btn text-white" href="">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="btn  text-white" href="">
                    <i class="fa fa-instagram"></i>
                </a>
            </li> -->
        </ul>
    </div>
</nav>
<!-- End Navbar ====
======================================= -->
    <?= $content; ?>
<!-- =====================================
==== Start Footer -->
<footer class="section-padding">
    <div class="container text-center">

        <a class="logo" href="#">
            <img src="<?= Url::to('@web/img/logo_white.png'); ?>" alt="logo" width="50px" height="30px">
        </a>

        <!-- <div class="social-icon">
            <a href="#0">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#0">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#0">
                <i class="fab fa-pinterest-p"></i>
            </a>
            <a href="#0">
                <i class="fab fa-behance"></i>
            </a>
            <a href="#0">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#0">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div> -->
        <p class="text-white">Copy Right 2018 &copy; By DCA All Rights Reserved</p>
    </div>
</footer>
<!-- End Footer ====
======================================= -->
<?php $this->endBody(); ?>
<script type="text/javascript">
        $('#carouselExample').on('slide.bs.carousel', function (e) {
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});
    </script>
</body>
</html>
<?php $this->endPage(); ?>