<div class="center-block">
<?php if (Yii::$app->session->hasFlash('voucher_code_success')): ?> 

<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
    <?= Yii::$app->session->getFlash('voucher_code_success') ?>
</div>

<?php endif; ?>




<?php if (Yii::$app->session->hasFlash('voucher_code_error')): ?>
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
    <?= Yii::$app->session->getFlash('voucher_code_error') ?>
</div>

<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('student_registration_success')): ?> 

<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
        
    <?= Yii::$app->session->getFlash('student_registration_success') ?>
</div>

<?php endif; ?>
<?php if (Yii::$app->session->hasFlash('student_registration_error')): ?> 

<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
        
    <?= Yii::$app->session->getFlash('student_registration_error') ?>
</div>

<?php endif; ?>


<?php if (Yii::$app->session->hasFlash('validate_existing_student_error')): ?> 

<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
        
    <?= Yii::$app->session->getFlash('validate_existing_student_error') ?>
</div>

<?php endif; ?>



<?php if (Yii::$app->session->hasFlash('error')): ?> 

<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <? print_r(Yii::$app->session->getFlash('error'));?>
        
    <? //Yii::$app->session->getFlash('error')[0] ?>
</div>

<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('success')): ?> 

<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        
        
    <?= Yii::$app->session->getFlash('success') ?>
</div>

<?php endif; ?>
<div>




