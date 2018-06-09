<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
    <div class="container">

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= Yii::$app->request->baseUrl.'/existing-student/validate' ?>" method="POST">

                            <input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>"/>
                            <!-- Material input email -->
                            <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="email" id="materialFormLoginEmailEx" class="form-control" name="email">
                                <label for="materialFormLoginEmailEx">Please Provide Us With Your email</label>
                            </div>

                            <div class="text-center mt-4">
                                <button class="btn btn-default" type="submit">Validate</button>
                            </div>

                        </form>
                    </div>
                   
                </div>
            </div>
        </div>

        <div class="jumbotron mt-5">
            <h1>Delyork Creative Academy</h1>

            <p>
                <a class="btn btn-lg btn-success" href="<?= Yii::$app->request->baseUrl.'/site/login' ?>">New Students</a>
                <a class="btn btn-lg btn-success" href="" data-toggle="modal" data-target="#exampleModal">Existing Students</a>
            </p>
        </div>

        <div class="body-content">

            <div class="row">
                
            </div>

        </div>
    </div>