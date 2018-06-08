<?php

namespace backend\controllers;

use Yii;
use common\models\Student;
use common\models\Tag;
use common\models\Tagging;
use common\models\StudentProject;
use common\models\CourseRegistration;
use common\models\VouchersAssignment;
use common\models\Voucher;
use app\models\StudentSearch;
use yii\web\Controller;
use common\models\LocalGovernment;
use common\models\Country;
use common\models\State;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
/**
 * StudentsController implements the CRUD actions for Student model.
 */
class StudentsController extends Controller
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
                    'delete' => ['POST', 'GET'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['related-states', 'related-local-government','confirm-member', 'sponsor', 'send-mail', ])) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }


    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionTag($id)
    {
        $provider = new ActiveDataProvider([
          'query' => Tagging::find()->where(['tag_id'=> $id]),
          'pagination' => [
              'pageSize' => 20,
          ],
        ]);


        return $this->render('tag', [
            //'searchModel' => $searchModel,
            'dataProvider' => $provider,

        ]);
    }


    /**
     * Displays a single Student model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $project = StudentProject::find()->where(['student_id'=> $id])->all();
        $taggings = Tagging::find()->where(['student_id'=> $id])->all();
        $tags = Tag::find()->all();
        $registered_courses = CourseRegistration::find()->where(['student_id'=> $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'projects' => $project,
            'taggings' => $taggings,
            'tags' => $tags,
            'registered_courses'=>$registered_courses
        ]);
    }

    /**
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
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

    public function actionConfirmMember()
    {
      $dca_tag = (int)Yii::$app->request->post('dca_tag');
      $id = Yii::$app->request->post('id');
      $db = Yii::$app->db;
      $db->beginTransaction();
      try {
          $tagging = new Tagging();
          $tagging->student_id = $id;
          $tagging->tag_id = $dca_tag;
          $tagging->save();

          $tag = Tag::find()->where(['id'=>$dca_tag])->one();
          if(count($tag)> 0 && $tag->voucher_category!==NULL){
              $selected_voucher = Voucher::find()->where(['voucher_category'=>$tag->voucher_category, 'status'=>'not used'])
              ->one();

              if(count($selected_voucher)>0){

                  $vouchers_assignment = new  VouchersAssignment();
                  $vouchers_assignment->voucher_id= $selected_voucher->id;
                  $vouchers_assignment->student_id=  $id;

                  if(!$vouchers_assignment->save()){
                      $msg = $vouchers_assignment->getErrors();

                      //exit;
                  }


              }
              if($tag->message!==NULL && $tag->notify_status==1){
                //send email
                  //Yii::$app->runAction('messaging/sponsorship_received',['email'=>$model->email_address]);
              }


          }
          $model = $this->findModel($id);
          return $this->redirect(['view', 'id' => $id]);

      } catch (\Exception $e) {
          $transaction->rollBack();
          throw $e;
      }

  }

    public function actionSponsor($id='')
    {
      if(!empty($id) && is_numeric($id)){
        $id = (int)$id;
        $db = Yii::$app->db;
        try {
            $db->createCommand()->update('students', ['sponsorship_status' => 1], 'id='.$id)->execute();

            return 'Student get sponsored';
        } catch (\Exception $e) {
            return 'failed';
        }

      }


    }

    public function actionRelatedStates($id)
    {
        $states = State::find()->where(['country_id' => $id])->all();
        if (count($states) > 0) {
          echo '<option value="">Select State </option>';
            foreach ($states as $state) {
                echo '<option value="'.$state->id.'">'.$state->name.'</option>';
            }
        } else {
            echo '<option> </option>';
        }
    }

    public function actionRelatedLocalGovernment($id)
    {
        $local_govts = LocalGovernment::find()->where(['state_id' => $id])->all();

        if (count($local_govts) > 0) {
              echo '<option value="">Select LGA </option>';
            foreach ($local_govts as $local_govt) {
                echo '<option value="'.$local_govt->id.'">'.$local_govt->name.'</option>';
            }
        } else {
            echo '<option> </option>';
        }
    }


    public function actionSendMail($value='')
    {
      # code...
    }

    /**
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
