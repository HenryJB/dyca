<?php   use yii\helpers\Url; ?>
<div class="row">

  <div class="col-md-8 offset-2">


    <?php if (count($errors) > 0): ?>
    <p class="alert-danger p-3">errors exists please check and fill again</p>
    <?php endif;?>

    <button type="button" class="btn btn-success btn-sm mb-3 rounded" data-toggle="modal" data-target="#Modal1">
      Add More Projects
    </button>

    <div class="comment-widgets scrollable ps-container ps-theme-default" data-ps-id="b65c4487-f538-6a4a-baab-ff500e736f16">

      <?php if (count($projects) > 0): ?>

      <?php foreach ($projects as $project): ?>
      <div class="card no-bg-color">
        <div class="card-body">
          <h4 class="card-title m-b-0">
            <?= $project->title?>
          </h4>
          <!-- Comment Row -->
          <div class="d-flex flex-row comment-row m-t-0">
            <?php if($project->type == 'video') :?>
            <div class="p-2">
              <video width="320" height="240" controls>
                <source src="<?= Url::to('@web/uploads/student-projects/videos/'.$project->attachment); ?>" type="video/mp4"> Your browser does not support the video tag.
              </video>
            </div>
            <?php endif;?>

            <?php if($project->type == 'photo') :?>
            <div class="p-2">
              <img src="<?= Url::to('@web/uploads/student-projects/images/'.$project->attachment); ?>" width="300px" height="300px">
            </div>
            <?php endif;?>



            <?php if($project->type == 'audio') :?>


            <div class="p-2">
              <audio controls>
                    <source src="<?=Url::to('@web/uploads/student-projects/audios/'.$project->attachment)?>" type="audio/mpeg">
                    Your browser does not support the audio tag.
                  </audio>
            </div>
            <?php endif;?>

            <?php if($project->type == 'pdf') :?>
            <div class="p-2">
              <img src="<?= Url::to('@web/uploads/student-projects/documents/pdf.jpg'); ?>" width="200px" height="200px">
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




                <?php if($project->type == 'pdf') :?>
                  <div class="p-2">
                    <div class="btn-group" role="group" aria-label="Basic example">

                      <a href="<?= Url::to(['project/delete','id' => $project->id])?>" class="btn btn-danger btn-sm rounded" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>
                        Delete</a>
                      <a href="<?= Url::to('@web/uploads/student-projects/documents/'.$project->attachment)?>" class="btn btn-success btn-sm rounded" onclick="return confirm('Are you sure?')"
                        target='_blank'> View</a>

                    </div>

                  </div>
                  <?php endif;?>

                  <?php if($project->type == 'audio') :?>
                  <div class="p-2">
                    <div class="btn-group" role="group" aria-label="Basic example">

                      <a href="<?= Url::to(['project/delete','id' => $project->id])?>" class="btn btn-danger btn-sm rounded" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>
                        Delete</a>
                      <a href="<?= Url::to('@web/uploads/student-projects/audios/'.$project->attachment)?>" class="btn btn-success btn-sm rounded" onclick="return confirm('Are you sure?')"
                        target='_blank'> <i class="fa fa-download"></i> Download</a>

                    </div>

                  </div>
                  <?php endif;?>

                  <?php if($project->type == 'photo' || $project->type == 'video') :?>
                    <div class="p-2">
                      <div class="btn-group" role="group" aria-label="Basic example">

                        <a href="<?= Url::to(['project/delete','id' => $project->id])?>" class="btn btn-danger btn-sm rounded" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>
                          Delete</a>

                      </div>

                    </div>
                  <?php endif;?>



              </div>
            </div>
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
        <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
      </div>
    </div>
  </div>
        </div>
