<?php   use yii\helpers\Url; ?>
<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-body">
        <h4 class="card-title m-b-0">Projects</h4>

        <?php if (count($errors) > 0): ?>
          <p class="alert-danger p-3">errors exists please check and fill again</p>
        <?php endif;?>

        <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="b65c4487-f538-6a4a-baab-ff500e736f16">

          <?php if (count($projects) > 0): ?>
          
          <?php foreach ($projects as $project): ?>
          <!-- Comment Row -->
          <div class="d-flex flex-row comment-row m-t-0">
            <?php if($project->type == 'video') :?>
              <div class="p-2">
                <video width="320" height="240" controls>
                  <source src="<?= Url::to('@web/uploads/student-projects/'.$project->attachment); ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            <?php endif;?>

            <?php if($project->type == 'photo') :?>
              <div class="p-2">
                <img src="<?= Url::to('@web/uploads/student-projects/'.$project->attachment); ?>" width="300px" height="300px">
              </div>
            <?php endif;?>

            
            
            <?php if($project->type == 'audio') :?>
              <div class="p-2">
                <img src="<?= Url::to('@web/uploads/student-projects/'.$project->attachment); ?>" width="300px" height="300px">
              </div>
            <?php endif;?>


            <div class="comment-text w-100">
              <h6 class="font-medium">
                <?= $project->title?>
              </h6>
              <span class="m-b-15 d-block">
                <?=$project->description?>. </span>
              <div class="comment-footer">
                <span class="text-muted float-right">
                  <?=$project->date?>
                </span>

                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal1">
                Add More Projects
                </button>
                  <a href="<?= Url::to(['students/project-delete','id' => $project->id])?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"> Delete</a>                
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php else: ?>
          <div class="alert alert-info padding-box mt-2 mb-2">
            <p class="">
              No projects Uploaded
            </p>
            <button type="button" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#Modal1">
              Upload Projects
            </button>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</div>


<!-- Modal for project upload -->
<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true ">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?= $this->render('_project_form', [
          'model' => $model,
      ]) ?>
      </div>
    </div>
  </div>
  </div