<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Tag;
use common\models\State;
use common\models\Country;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if (Yii::$app->session->hasFlash('error')): ?>

    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

        <?= Yii::$app->session->getFlash('error') ?>
    </div>

<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>

    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

        <?= Yii::$app->session->getFlash('success') ?>
    </div>

<?php endif; ?>

<div class="student-view">

    <!-- modal medium -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Email Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                    <form action="<?php echo Yii::$app->request->baseUrl ?>/messaging/mail-student" method="post">
                        <?php $email =  'noreply.delyorkinternational.com' ?>
                        <?php $id =  0 ?>

                        <?php if(!empty($model->email_address) && !empty($model->id)) : ?>
                            <?php $email = $model->email_address?>
                            <?php $id   = $model->id?>
                        <?php endif;?>


                        <input type="hidden" name="email_address" value='<?= $email  ?>'>
                        <input type="hidden" name="id" value='<?= $id  ?>'>
                        <div class="form-group">
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" />
                        </div>
                        <div class="form-group">
                            <textarea cols="6" rows="10" class="form-control" name="email_body" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class='fa fa-envelope'></i> Send Email
                        </button>

                    </form>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- end modal medium -->


    <!-- modal small -->
    <div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"
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
                        <input type="hidden" name="id" value="<?= $model->id ?>"/>
                        <select class="form-control" name="dca_tag" id="dca_tag">
                            <?php if (count($tags) > 0) : ?>
                                <?php foreach ($tags as $tag): ?>
                                    <option value="<?= $tag->id ?>">
                                        <?= $tag->name ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" onclick=" confirm('Are you sure?');">Confirm</button>
                        </div>
                    </form>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <!-- end modal small -->

    <div id="profile-box" class="row">
        <div class="col-sm-12">
            <!-- Alert Notification -->
            <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                <p class="alert-msg-box">

                </p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- Alert Notification -->

        </div>

        <div class="col-sm-12">
            <div class="card" style="border:none !important">
                <div class="card-header">
                    <h4>
                        <?= Html::a('<i class="fa fa-envelope"></i>', ['#'],
                            ['class' => 'modal-mail btn btn-danger', 'data-toggle' => 'tooltip',
                                'data-placement' => 'top', 'data-original-title' => 'Send Email']) ?>
                        <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id],
                            ['class' => 't btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Update']) ?>
                        <?= Html::a('<i class="fa fa-tag"></i>', ['confirm-member', 'id' => $model->id],
                            ['class' => 'tag-box btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Give a tag']) ?>

                        <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id],
                            ['class' => 'btn btn-danger',
                                'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Delete',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'get',
                                ],
                            ]) ?>
                    </h4>
                </div>
                <div class="card-body card__body">
                    <!-- tab navigation -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab"
                               href="#custom-nav-home" role="tab" aria-controls="custom-nav-home"
                               aria-selected="true">About</a>
                            <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab"
                               href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile"
                               aria-selected="false">Courses</a>
                            <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab"
                               href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact"
                               aria-selected="false">Projects</a>
                        </div>
                    </nav>
                    <!-- tab navigation -->

                    <!-- tab container -->
                    <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                        <!-- start tab content -->
                        <div class="tab-pane fade active show m-3" id="custom-nav-home" role="tabpanel"
                             aria-labelledby="custom-nav-home-tab">

                            <div class="row">

                                <div class="col-md-4 col-sm-4 mt-5 mb-4 pl-0">
                                    <?php $photo = !empty($model->photo) || $model->photo !== NULL ? $model->photo : 'default-avatar.gif' ?>
                                    <?= Html::img('@web/uploads/students/' . $photo, ['class' => 'rounded-circle d-block', 'style' => 'width:300px; height:300px;']) ?>
                                </div>

                                <div class="col-md-8 col-sm-8 mt-5 align-self-center">
                                    <?php $firstname = !empty($model->first_name) || $model->first_name !== NULL ? $model->first_name : 'N/A' ?>
                                    <?php $lastname = !empty($model->last_name) || $model->last_name !== NULL ? $model->last_name : 'N/A' ?>
                                    <h2 class="text-white mt-25 bebas_neue">
                                        <?= $firstname . ' ' ?>
                                        <?= $lastname ?>
                                    </h2>
                                </div>

                                <div class="col-xl-12 col-md-lg col-md-12 col-sm-12 col-xs-12 mt-3 mb-3">
                                    <h3 class="text-white bebas_neue">
                                        <i class="fa fa-user"></i>&nbspABOUT</h3>
                                    <p class="text-white">
                                        <?= $model->about ?>
                                    </p>
                                </div>

                                <div class="col-sm-3">
                                    <p class="font-weight-bold">DATE OF BIRTH</p>
                                    <p>
                                        <?= $model->date_of_birth ?>
                                    </p>
                                </div>

                                <div class="col-sm-3">
                                    <p class="font-weight-bold">GENDER</p>
                                    <p>
                                        <?= $model->gender ?>
                                    </p>
                                </div>

                                <div class="col-sm-3">
                                    <p class="font-weight-bold">STATE OF ORIGIN</p>
                                    <?php $get_state = State::find()->where(['id' => $model->state_id])->one(); ?>
                                    <?php $state = !empty($get_state->name) || $get_state->name !== NULL ? $get_state->name : 'N/A' ?>
                                    <p>
                                        <?= $state ?>
                                    </p>
                                </div>

                                <div class="col-sm-3">
                                    <p class="font-weight-bold">NATIONALITY</p>
                                    <?php $get_country = Country::find()->where(['id' => $model->country])->one(); ?>
                                    <?php $country = !empty($get_country->name) || $get_country->name !== NULL ? $get_country->name : 'N/A' ?>
                                    <p>
                                        <?= $country ?>
                                    </p>
                                </div>

                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col-md-12 col-xs-12 mb-3">
                                    <h3 class="text-white bebas_neue">
                                        <i class="fa fa-envelope"></i> CONTACT INFORMATION</h3>
                                </div>

                                <div class="col-sm-4">
                                    <p class="font-weight-bold">PHONE NUMBER</p>
                                    <p>
                                        <?= $model->phone_number ?>
                                    </p>
                                </div>

                                <div class="col-sm-4">
                                    <p class="font-weight-bold">EMAIL ADDRESS</p>
                                    <p>
                                        <?= $model->email_address ?>
                                    </p>
                                </div>

                                <div class="col-sm-4">
                                    <p class="font-weight-bold">CONTACT ADDRESS</p>
                                    <p>
                                        <?= $model->contact_address ?>
                                    </p>
                                </div>

                                <div class="col-sm-4">
                                    <p class="font-weight-bold">FACEBOOK</p>
                                    <p>
                                        <?php $facebook = !empty($model->facebook_id) || $model->facebook_id !== NULL ? $model->facebook_id : 'N/A' ?>
                                        <?= $facebook ?>
                                    </p>
                                </div>

                                <div class="col-sm-4">
                                    <p class="font-weight-bold">TWITTER</p>
                                    <p>
                                        <?php $twitter = !empty($model->twitter_handle) || $model->twitter_handle !== NULL ? $model->twitter_handle : 'N/A' ?>
                                        <?= $twitter ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col-md-12 col-xs-12 mb-3">
                                    <h3 class="text-white bebas_neue">
                                        <i class="fa fa-star"></i> SKILLS</h3>

                                </div>
                                
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col-md-12 col-xs-12 mb-3">
                                    <h3 class="text-white bebas_neue">
                                        <i class="fa fa-tags"></i> TAGGING
                                    </h3>
                                </div>

                                <div class="col-xs-7 col-md-7 controls">
                                    <?php if (count($taggings) > 0): ?>
                                        <?php foreach ($taggings as $tagging): ?>

                                            <?php $student_tag = Tag::find()->where(['id' => $tagging->tag_id])->one(); ?>

                                            <?php if ($student_tag!==null) : ?>
                                                <a class="btn btn-danger "
                                                   href="<?= Yii::$app->request->baseUrl ?>/students/tag?id=<?= $student_tag->id ?>">
                                                      <span class="badge badge-dark">
                                                        <?= $student_tag->name ?>
                                                      </span>
                                                </a>
                                            <?php endif ?>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel"
                             aria-labelledby="custom-nav-profile-tab">

                            <?php if (count($registered_courses) > 0): ?>
                                <?php foreach ($registered_courses as $course_applied): ?>
                                    <?php $course = $course_applied->getCourseInSession()->andWhere('id=' . $course_applied->course_in_session_id)->one(); ?>

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <?php $applied_course = $course->getCourse()->andWhere('id=' . $course->course_id)->one(); ?>
                                                <img src="<?= Url::to('@web/uploads/courses/' . $applied_course->photo); ?>" class="img-fluid img-rounded">
                                                <h3 class="font-weight-bold student__course__listing"><?= $applied_course->name ?></h3>
                                            </div>
                                            <div class="col-md-4" style="padding-top:36px">
                                                <div class="row">
                                                    <div class=" col-md-12">
                                                        <h3>START DATE</h3></div>
                                                    <div class="col-md-12 line-compressed"><?= $course->start_date ?></div>
                                                </div>

                                                <div class="row">
                                                    <div class=" col-md-12"><h3 class="title-light font-14">COST</h3>
                                                    </div>
                                                    <div class="col-md-12 line-compressed">
                                                        $<?= number_format($applied_course->fee, 2); ?></div>
                                                </div>

                                                <div class="row">
                                                    <div class=" col-md-12"><h3 class="title-light font-14">STATUS</h3>
                                                    </div>
                                                    <div class="col-md-12 line-compressed"><?= $course_applied->payment_status ?></div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                        <div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
                            
                            <?php if (count($projects) > 0): ?>                                        
                                <div class="row">                                                                            
                                     <?php foreach ($projects as $project): ?>
                                         <div class="col-md-4 pl-0">
                                            <div class="card project__cards">
                                                <div class="card-header">                                        
                                                    <?php if(!empty($project->title)):  ?>
                                                            <p><?= $project->title ?></p>
                                                        <?php else:?>
                                                            <p>Content Error</p>
                                                    <?php endif;?>

                                                  </div>
                                                    <div class="card-body">
                                                        <?php if($project->type == 'audio' && !empty($project->attachment)):?>
                                                            <?php $link = Url::to('@web/uploads/student-projects/audios/' . $project->attachment); ?>
                                                            
                                                             <audio controls>
                                                                    <source src="<?=  $link?>" type="audio/mpeg">                                                            
                                                                    Your browser does not support the audio tag.
                                                            </audio>

                                                        <?php elseif($project->type == 'video' && !empty($project->attachment)): ?>
                                                            <?php $link = Url::to('@web/uploads/student-projects/videos/' . $project->attachment); ?>                                                    
                                                             <video width="100%" height="100%" controls>
                                                                    <source src="<?= $link ?>" type="video/mp4">                                                     
                                                                    Your browser does not support the video tag.
                                                            </video>

                                                        <?php elseif($project->type == 'pdf' && !empty($project->attachment)):?>
                                                            <?php $link = Url::to('@web/uploads/student-projects/documents/'.$project->attachment); ?>
                                                            
                                                            <img src="<?= Url::to('@web/uploads/student-projects/documents/pdf.jpg'); ?>" width="200px" height="200px">                                                     
                                                             <a href="<?= $link ?>" class="btn btn-success btn-sm rounded" 
                                                                onclick="return confirm('Are you sure?')" target='_blank'> View</a>

                                                        <?php elseif($project->type == 'photo' && !empty($project->attachment)):?>                                                            
                                                            <?php $link = Url::to('@web/uploads/student-projects/images/'.$project->attachment); ?>
                                                            <img src="<?= $link; ?>" width="200px" height="200px">

                                                        <?php else:?>
                                                                <p>Content Error</p>
                                                        <?php endif;?>
                                                    </div>                                                          
                                            </div>
                                        </div>   
                                     <?php endforeach; ?>                                                   
                                </div>                                                                                          
                            <?php else: ?>
                                <div class="col-md-4 pl-0">
                                    <div class="card project__cards">
                                        <div class="card-body">
                                            <p class="card-title">Student has no project</p>
                                        </div>                                        
                                    </div>
                                </div>
                            <?php endif; ?>
                               
                        </div>
                    </div>
                    <!-- end tab content -->
                </div>
            </div>
        </div>
    </div>
</div>
