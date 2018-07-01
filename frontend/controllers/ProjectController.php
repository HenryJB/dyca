<?php

namespace frontend\controllers;

use common\models\StudentProject;
use common\models\Student;

use yii;

class ProjectController extends \yii\web\Controller
{
    public $layout = 'profile-layout';



    public function beforeAction($action)
    {
        if (in_array($action->id, ['create'])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    public function actionIndex()
    {
        $session = Yii::$app->session;
        $errors = '';

        $model = new StudentProject();

        $projects = StudentProject::find()->where(['student_id' => $session->get('id')])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->student_id = $session->get('id');

            $model->attachment = $model->upload($model);

            $model->date = date('Y-m-d');

            if (!empty($model->attachment)) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                    return $this->redirect('index');
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                return $this->redirect('index');
            }
        }

        return $this->render('index', ['projects' => $projects, 'model' => $model, 'errors' => $model->errors]);
    }


    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $errors = '';

        $model = new StudentProject();

        $projects = StudentProject::find()->where(['student_id' => $session->get('id')])->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->student_id = $session->get('id');

            $model->attachment = $model->upload($model);

            $model->date = date('Y-m-d');

            if (!empty($model->attachment)) {
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                    return $this->redirect('index');
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Project uploaded successfully. Upload more or click the finish button');
                return $this->redirect('index');
            }
        }

        return $this->renderPartial('create', [
            'model' => $model, 'errors' => $model->errors
        ]);
    }



    public function actionDelete($id)
    {
        $project = StudentProject::findOne($id)->delete();

        if ($project) {
            Yii::$app->session->setFlash('success', 'Project deleted');
            return $this->redirect('index');
        }

        Yii::$app->session->setFlash('error', 'Project could not be deleted');

        return $this->redirect('index');
    }

}
