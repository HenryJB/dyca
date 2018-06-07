<?php   
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url; 
    use common\models\Course;
?>

<div class="row">
    <div class="col-md-8 offset-md-2">


        <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="b65c4487-f538-6a4a-baab-ff500e736f16">

            <?php if (count($courses_applied) > 0): ?>

            <?php foreach ($courses_applied as $course_applied): ?>
            <?php $course= $course_applied->getCourse()->andWhere('id='.$course_applied->course_id)->one();?>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title m-b-0"><?= $course->name?></h4>

                    <div class="d-flex flex-row comment-row m-t-0">
                        
                        <div class="p-2">
                            <img src="<?= Url::to('@web/uploads/courses/'.$course->photo); ?>" class="img-fluid" width="400px" height="400px">
                        </div>
                        
                        <div class="comment-text w-100">
                     
                            <span class="m-b-15 d-block">
                                <?= $course->description?>
                                    . </span>
                            <div class="comment-footer">
                                <span class="text-muted float-right">

                                </span>

                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal1">
                                    Apply to another course
                                </button>

                                <a href="<?= Url::to(['course-applied/delete','id' => $course_applied->id])?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

                <?php endforeach; ?>
                <?php else:?>
                <div class="comment-footer ml-4">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal1">
                        Apply to another
                    </button>
                </div>

                <?php endif; ?>


            </div>
        </div>
    </div>


    <!-- Modal for Course Selection -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
        <div class="modal-dialog" role="document ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true ">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <div class="col-xs-12 col-sm-6 col-lg-12">
                        <?= $form->field($model, 'course_id')->dropDownList($courses, ['prompt' => '']) ?>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-lg-12">
                        <?= $form->field($model, 'session_id')->dropDownList($sessions, ['prompt' => '']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Apply', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        </div