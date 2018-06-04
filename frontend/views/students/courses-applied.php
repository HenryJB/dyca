<?php   use yii\helpers\Url; ?>
<div class="row">
  <div class="col-md-12">
      <div class="card">
          <div class="card-body">
              <h4 class="card-title m-b-0">Courses Applied</h4>
          </div>
          <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="b65c4487-f538-6a4a-baab-ff500e736f16">

            <?php if (count($courses_applied) > 0): ?>
            <?php foreach ($courses_applied as $course): ?>
              <!-- Comment Row -->
              <div class="d-flex flex-row comment-row m-t-0">
                  <div class="p-2"><img src="<?= Url::to('@web/uploads/courses/'.$course->photo); ?>" width="300px" height="300px"></div>
                  <div class="comment-text w-100">
                      <h6 class="font-medium"><?=$course->name?></h6>
                      <span class="m-b-15 d-block"><?=$course->description?>. </span>
                      <div class="comment-footer">
                          <span class="text-muted float-right"><?=$course->duration?></span>
                          <button type="button" class="btn btn-cyan btn-sm">Change Course</button>
                          <button type="button" class="btn btn-success btn-sm">Add More Courses</button>
                          <button type="button" class="btn btn-danger btn-sm">Delete</button>
                      </div>
                  </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
                </div>
              </div>
        </div>
</div>
