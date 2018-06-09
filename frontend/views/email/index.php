<?php   
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url; 
    use common\models\Course;
?>

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="b65c4487-f538-6a4a-baab-ff500e736f16">

            <?php if (count($emails) > 0): ?>


            <?php foreach ($emails as $email): ?>
            <div class="card">
                <div class="card-body">

                    <?php $message= $email->getEmailTemplate()->one();?>


                    <?php if(!empty($message)): ?>
                    <h4 class="card-title m-b-0"><?= $message->subject ?></h4>
                    <div class="d-flex flex-row comment-row m-t-0">

                        <div class="comment-text w-100">
                            <h6 class="font-medium">
                                <?= $message->subject?>
                            </h6>
                            <span class="m-b-15 d-block">
                                <?= $message->body?>
                                    . </span>
                            <div class="comment-footer">

                                <a href="<?= Url::to(['email/delete','id' => $email->id])?>" class="btn btn-danger btn-sm rounded" onclick="return confirm('Are you sure?')">
                                    Delete</a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

            <?php endforeach; ?>

            <?php else:?>
            <div class="alert alert-info padding-box mt-2 mb-2">
                <p class="">
                Inbox Empty
                </p>
                
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>