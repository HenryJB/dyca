<?php

namespace backend\controllers;

use common\models\AlumniProject;
use Yii;
use common\models\Alumni;
use common\models\AlumniSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image as ImageBox;
use Imagine\Image\Box;
use yii\helpers\Url;

/**
 * AlumniController implements the CRUD actions for Alumni model.
 */
class AlumniController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Alumni models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlumniSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Alumni model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $project = AlumniProject::find()->where(['alumni_id'=> $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'projects' => $project,
        ]);
    }

    public function actionPicture()
    {
        $model = new Alumni();

        $requestval = \Yii::$app->request->post();
        $con = 'id = '.$requestval['id'];

        $alumni = Alumni::find()->where(['id'=> $requestval['id']])->one();


        if ( file_exists(Url::to('@backend/web/uploads/alumni/'.$alumni->photo)) == true ) {

            if(unlink(Url::to('@backend/web/uploads/alumni/'.$alumni->photo)) && unlink(Url::to('@backend/web/uploads/alumni/thumbs/'.$alumni->photo)))
            { $filename = $this->save_base64_image($requestval['img'],$alumni->first_name,'/web/uploads/alumni/');
                $db = Yii::$app->db;
                $transaction = $db->beginTransaction();
                try {
                    $db->createCommand()->update('alumni', ['photo' => $filename],$con)->execute();
                    // ... executing other SQL statements ...

                    $transaction->commit();
                    return 'Upload successful';
                } catch(\Exception $e) {
                    return 'failed';
                }
            }
        }else{
            $filename = $this->save_base64_image($requestval['img'],$alumni->first_name,'/web/uploads/alumni/');
            $db = Yii::$app->db;
            $transaction = $db->beginTransaction();
            try {
                $db->createCommand()->update('alumni', ['photo' => $filename],$con)->execute();
                // ... executing other SQL statements ...

                $transaction->commit();
                return 'Upload successful';
            } catch(\Exception $e) {
                return 'failed';
            }
        }
        return 'failed';

    }


    /**
     * Creates a new Alumni model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Alumni();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->load(Yii::$app->request->post())) {
                $model->photo = UploadedFile::getInstance($model, 'photo');

                if ($model->photo !== null) {
                    if ($model->save() && $model->upload()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }


            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Alumni model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Alumni model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Alumni model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Alumni the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Alumni::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    function save_base64_image($base64_image_string, $output_file_without_extentnion, $path_with_end_slash="" ) {
        //usage:  if( substr( $img_src, 0, 5 ) === "data:" ) {  $filename=save_base64_image($base64_image_string, $output_file_without_extentnion, getcwd() . "/application/assets/pins/$user_id/"); }
        //
        //data is like:    data:image/png;base64,asdfasdfasdf
        $output_file_with_extentnion='';
        $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
        $mime=$splited[0];
        $data=$splited[1];

        $mime_split_without_base64=explode(';', $mime,2);
        $mime_split=explode('/', $mime_split_without_base64[0],2);
        if(count($mime_split)==2)
        {
            $extension=$mime_split[1];
            if($extension=='jpeg')$extension='jpg';
            //if($extension=='javascript')$extension='js';
            //if($extension=='text')$extension='txt';
            $output_file_with_extentnion.=$output_file_without_extentnion.'.'.$extension;
        }
        file_put_contents(Url::to('@backend/web/uploads/alumni/'.$output_file_with_extentnion), base64_decode($data) );
        return $output_file_with_extentnion;
    }
}
