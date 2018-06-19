
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <?php $this->head(); ?>

</head>
<body>
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
     <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar"
  
       <div class="container">
       
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent-7" style="">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
              <img src="http://www.delyorkcreative.academy/wp-content/uploads/2018/05/DCA-Logo-36.png" alt="logo" width="112" height="69"
                class="imf-fluid">
            </li>


          </ul>
          
        </div>
      </div>
    </nav>
    
    <?= $content; ?>

<?php $this->beginBody(); ?> 

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


</body>
</html>
<?php $this->endPage(); ?>