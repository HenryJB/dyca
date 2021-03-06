<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

use yii\helpers\Url;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="animsition">
<?php $this->beginBody() ?>

<div class="page-wrapper">
  <!-- HEADER MOBILE-->
  <header class="header-mobile d-block d-lg-none">
      <div class="header-mobile__bar">
          <div class="container-fluid">
              <div class="header-mobile-inner">
                  <a class="logo" href="index.html">
                      <img src="images/icon/logo.png" alt="CoolAdmin" />
                  </a>
                  <button class="hamburger hamburger--slider" type="button">
                      <span class="hamburger-box">
                          <span class="hamburger-inner"></span>
                      </span>
                  </button>
              </div>
          </div>
      </div>
      <nav class="navbar-mobile">
          <div class="container-fluid">
              <ul class="navbar-mobile__list list-unstyled">
                  <li class="has-sub">
                      <a class="js-arrow" href="#">
                          <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                                <?=Html::a('Dashboard', ['site/index'])?>
                          </li>
                          <li>
                                <?=Html::a('Settings', ['settings/index'])?>
                          </li>

                      </ul>
                  </li>

                  <li class="has-sub">
                      <a class="js-arrow" href="#">
                          <i class="fas fa-users"></i>Students</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                          <li>
                                <?=Html::a('List', ['students/index'])?>
                          </li>

                      </ul>
                  </li>
                  <li class="has-sub">
                      <a class="js-arrow" href="#">
                          <i class="fas fa-list"></i>Reports</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                                <?=Html::a(' New Student', ['students/create'])?>
                          </li>
                          <li>
                                <?=Html::a('List', ['students/index'])?>
                          </li>

                      </ul>
                  </li>


                  <li>
                      <a href="form.html">
                          <i class="far fa-check-square"></i>Forms</a>

                  </li>


                  <li class="has-sub">
                      <a class="js-arrow" href="#">
                          <i class="fas fa-copy"></i>Pages</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                              <a href="login.html">Login</a>
                          </li>
                          <li>
                              <a href="register.html">Register</a>
                          </li>
                          <li>
                              <a href="forget-pass.html">Forget Password</a>
                          </li>
                      </ul>
                  </li>
                  <li class="has-sub">
                      <a class="js-arrow" href="#">
                          <i class="fas fa-desktop"></i>UI Elements</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                              <a href="button.html">Button</a>
                          </li>
                          <li>
                              <a href="badge.html">Badges</a>
                          </li>
                          <li>
                              <a href="tab.html">Tabs</a>
                          </li>
                          <li>
                              <a href="card.html">Cards</a>
                          </li>
                          <li>
                              <a href="alert.html">Alerts</a>
                          </li>
                          <li>
                              <a href="progress-bar.html">Progress Bars</a>
                          </li>
                          <li>
                              <a href="modal.html">Modals</a>
                          </li>
                          <li>
                              <a href="switch.html">Switchs</a>
                          </li>
                          <li>
                              <a href="grid.html">Grids</a>
                          </li>
                          <li>
                              <a href="fontawesome.html">Fontawesome Icon</a>
                          </li>
                          <li>
                              <a href="typo.html">Typography</a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </div>
      </nav>
  </header>
  <!-- END HEADER MOBILE-->


  <!-- MENU SIDEBAR-->
  <aside class="menu-sidebar d-none d-lg-block">
      <div class="logo mt-5">
          <a href="#">            
              <img src="<?= Url::to('@web/images/dcalogo.png') ?>" alt="Cool Admin" /> 
          </a>
      </div>
      <div class="menu-sidebar__content js-scrollbar1">
          <nav class="navbar-sidebar">
              <ul class="list-unstyled navbar__list">
                <li class="has_sub">
                   
                    <a class="js-arrow" href="#" class="hover_link">
                          <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                                <?=Html::a(' Settings', ['setting/index'])?>
                          </li>
                          <li>
                                <?=Html::a('Emails', ['email/index'])?>
                          </li>
                          <li>
                                <?=Html::a('Email Templates', ['email-template/index'])?>
                          </li>
 
                          <li>
                                <?=Html::a('Tags', ['tags/index'])?>
                          </li>

                          <li>
                                <?=Html::a('Tag Categories', ['tag-category/index'])?>
                          </li>
                      </ul>


                </li>

                  <li class="has-sub">
                      <a class="js-arrow" href="#" class="hover_link">
                          <i class="fas fa-users"></i>Student Manager</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                                <?=Html::a('Students', ['students/index'])?>
                          </li>
                      </ul>
                  </li>
                
                  <li class="has-sub">
                      <a class="js-arrow" href="#" class="hover_link">
                          <i class="fas fa-credit-card"></i>Payment Manager</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                                <?=Html::a(' Payments', ['payments/index'])?>
                          </li>
                      </ul>
                  </li>

                  <li class="has-sub">
                      <a class="js-arrow" href="#" class="hover_link">
                          <i class="fas fa-credit-card"></i>Grant Manager</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                          <li>
                                <?=Html::a('Grants', ['grant/index'])?>
                          </li>
                      </ul>
                  </li>

                  <li class="has-sub">
                      <a class="js-arrow" href="#" class="hover_link">
                          <i class="fas fa-list"></i>Course Manager</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                          <li>
                                <?=Html::a('Courses', ['courses/index'])?>
                          </li>
                          <li>
                                <?=Html::a('Instructors', ['instructors/index'])?>
                          </li>

                      </ul>
                  </li>


                  <li class="has-sub">
                      <a class="js-arrow" href="#" class="hover_link">
                          <i class="fas fa-envelope"></i>Voucher Manager</a>
                      <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                              <?=Html::a('Voucher Categories', ['voucher-categories/index'])?>
                        </li>
                          <li>
                                <?=Html::a('Vouchers', ['vouchers/index'])?>
                          </li>
                          <li>
                                <?=Html::a('Voucher Assignment', ['vouchers-assignment/index'])?>
                          </li>
                      </ul>
                  </li>




              </ul>
          </nav>
      </div>
  </aside>
  <!-- END MENU SIDEBAR-->
  <div class="page-container">
      <!-- HEADER DESKTOP-->
      <header class="header-desktop">
          <div class="section__content section__content--p30">
              <div class="container-fluid">
                  <div class="header-wrap float-right mt-5">
                      <div class="header-button">
                          <div class="noti-wrap">
                              <div class="noti__item js-item-menu">
                                  <i class="zmdi zmdi-money"></i>
                                  <span class="quantity">1</span>
                                  <div class="mess-dropdown js-dropdown">
                                      <div class="mess__title">
                                          <p>Payment Notifications</p>
                                      </div>
                                      <div class="mess__item">
                                          <div class="image img-cir img-40">
                                              <i class="zmdi zmdi-money"></i>
                                          </div>
                                          <div class="content">
                                              <h6>Michelle Moreno</h6>
                                              <p>Have sent a photo</p>
                                              <span class="time">3 min ago</span>
                                          </div>
                                      </div>
                                      <div class="mess__item">
                                          <div class="image img-cir img-40">
                                              <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                          </div>
                                          <div class="content">
                                              <h6>Diane Myers</h6>
                                              <p>You are now connected on message</p>
                                              <span class="time">Yesterday</span>
                                          </div>
                                      </div>
                                      <div class="mess__footer">
                                          <a href="#">View all messages</a>
                                      </div>
                                  </div>
                              </div>
                              <div class="noti__item js-item-menu">
                                  <i class="zmdi zmdi-account"></i>
                                  <span class="quantity">1</span>
                                  <div class="email-dropdown js-dropdown">
                                      <div class="email__title">
                                          <p>You have 3 New Emails</p>
                                      </div>
                                      <div class="email__item">
                                          <div class="image img-cir img-40">
                                              <img src="images/icon/avatar-06.jpg" alt="Cynthia Harvey" />
                                          </div>
                                          <div class="content">
                                              <p>Meeting about new dashboard...</p>
                                              <span>Cynthia Harvey, 3 min ago</span>
                                          </div>
                                      </div>
                                      <div class="email__item">
                                          <div class="image img-cir img-40">
                                              <img src="images/icon/avatar-05.jpg" alt="Cynthia Harvey" />
                                          </div>
                                          <div class="content">
                                              <p>Meeting about new dashboard...</p>
                                              <span>Cynthia Harvey, Yesterday</span>
                                          </div>
                                      </div>
                                      <div class="email__item">
                                          <div class="image img-cir img-40">
                                              <img src="images/icon/avatar-04.jpg" alt="Cynthia Harvey" />
                                          </div>
                                          <div class="content">
                                              <p>Meeting about new dashboard...</p>
                                              <span>Cynthia Harvey, April 12,,2018</span>
                                          </div>
                                      </div>
                                      <div class="email__footer">
                                          <a href="#">See all emails</a>
                                      </div>
                                  </div>
                              </div>
                              <div class="noti__item js-item-menu">
                                  <i class="zmdi zmdi-notifications"></i>
                                  <span class="quantity">3</span>
                                  <div class="notifi-dropdown js-dropdown">
                                      <div class="notifi__title">
                                          <p>You have 3 Notifications</p>
                                      </div>
                                      <div class="notifi__item">
                                          <div class="bg-c1 img-cir img-40">
                                              <i class="zmdi zmdi-email-open"></i>
                                          </div>
                                          <div class="content">
                                              <p>You got a email notification</p>
                                              <span class="date">April 12, 2018 06:50</span>
                                          </div>
                                      </div>
                                      <div class="notifi__item">
                                          <div class="bg-c2 img-cir img-40">
                                              <i class="zmdi zmdi-account-box"></i>
                                          </div>
                                          <div class="content">
                                              <p>Your account has been blocked</p>
                                              <span class="date">April 12, 2018 06:50</span>
                                          </div>
                                      </div>
                                      <div class="notifi__item">
                                          <div class="bg-c3 img-cir img-40">
                                              <i class="zmdi zmdi-file-text"></i>
                                          </div>
                                          <div class="content">
                                              <p>You got a new file</p>
                                              <span class="date">April 12, 2018 06:50</span>
                                          </div>
                                      </div>
                                      <div class="notifi__footer">
                                          <a href="#">All notifications</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="account-wrap">
                              <div class="account-item clearfix js-item-menu">

                                  <div class="content">
                                      <a class="js-acc-btn text-white" href="#">
                                        <?= \Yii::$app->user->identity->username; ?>
                                      </a>
                                  </div>
                                  <div class="account-dropdown js-dropdown">
                                      <div class="info clearfix">
                                          <div class="content">
                                              <h5 class="name">
                                                  <a href="#"><?= \Yii::$app->user->identity->username; ?></a>                                              
                                              </h5>
                                              
                                          </div>
                                      </div>
                                      <div class="account-dropdown__body">
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-account"></i>Account</a>
                                          </div>
                                          <div class="account-dropdown__item">
                                              <a href="#">
                                                  <i class="zmdi zmdi-settings"></i>Setting</a>
                                          </div>
                                         
                                      </div>
                                      <div class="account-dropdown__footer">
                                        <?=Html::a('<i class="zmdi zmdi-power"></i>Logout', ['site/logout'])?>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </header>
      <!-- HEADER DESKTOP-->

      <!-- MAIN CONTENT-->
      <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 ml-auto">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => [
                            'id' => 'student__breadcrumb',
                            'class' => 'breadcrumb'
                        ]
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="section__content section__content--cp30">
            <?= $content ?>
        </div>



      </div>
      <!-- END MAIN CONTENT-->
      <!-- END PAGE CONTAINER-->
  </div>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
</footer>



<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
