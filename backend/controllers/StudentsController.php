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
use backend\models\StudentSearch;
use yii\web\Controller;
use common\models\LocalGovernment;
use common\models\Country;
use common\models\State;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
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
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'tag', 'view', 'create', 'update','confirm-member','sponsor','related-states','related-local-government'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
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
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags' => $tags,
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
        ///  $db = Yii::$app->db;
        //  $db->beginTransaction();
        try {

            $tagging = Tagging::find()->where(['tag_id' => $dca_tag, 'student_id' => $id])->one();

            if(count($tagging) == 0){
                $tagging = new Tagging();
                $tagging->student_id = $id;
                $tagging->tag_id = $dca_tag;
    
                if(!$tagging->save()){
                    //TODO set flash session here
                    //TODO do a redirect here            
                //print_r($tagging->getErrors());
                //exit;
                Yii::$app->session->setFlash('success', 'Tag added to student');
                }
            }
            

            $model = $this->findModel($id);
            
            $tag = Tag::find()->where(['id'=>$dca_tag])->one();
            
            if(count($tag)> 0 || $tag->voucher_category!==NULL){
                $selected_vouchers = Voucher::find()
                ->where(['voucher_category'=>$tag->voucher_category, 'status'=>'not used'])
                ->all();

                if(count($selected_vouchers)>0){

                    $vouchers_assignment = new  VouchersAssignment();
                    $vouchers_assignment->voucher_id= $selected_vouchers[0]->id;
                    $vouchers_assignment->student_id=  $id;

                    if(!$vouchers_assignment->save()){
                        //$msg = $vouchers_assignment->getErrors();
                        //print_r($vouchers_assignment->getErrors());
                        Yii::$app->session->setFlash('error', 'Voucher has been assigned');
                    }else{

                        $update_voucher = Voucher::find()->where(['id'=>$selected_vouchers[0]->id])->one();
                        $update_voucher->status= 'assigned';
                        $update_voucher->update();

                        Yii::$app->session->setFlash('success', 'Voucher Status changed');

                    }


                }
                if($tag->message != NULL && $tag->notify_status==1 && count($selected_vouchers) > 0){ 
                    
                    Yii::$app->runAction('messaging/tagging',['body'=>$tag->message, 'voucher' => $selected_vouchers[0]->code, 'id' => $id, 'email_template' => 3]);
                }
                else{
                    Yii::$app->session->setFlash('error', 'Voucher has been assigned');
                }


            }

            return $this->redirect(['view', 'id' => $id]);

        } catch (\Exception $e) {
            //TODO add session falsh here to this place
            //REDIRECT BACK
            //  $transaction->rollBack();
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

    /**
     * actionFilterStudentByTags
     *
     * @return void
     */
    public function actionFilterStudentByTags()
    {
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'name');

        if(Yii::$app->request->post('tag_id')){
            (int)$tag_id    = Yii::$app->request->post('tag_id');
            $models         = Tagging::find()->where(['tag_id' => $tag_id])->all();
           
            $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'name');
            return $this->render('filterbytags', [
                'tags' => $tags,
                'models' => $models,
            ]);
        }else
        {
            $models  = !empty($tag_id) ? Tagging::find()->where(['tag_id' => $tag_id])->all() : Tagging::find()->all();
           
            $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'name');

            return $this->render('filterbytags', [
                'tags' => $tags,
                'models' => $models,
            ]);
        }
        //get a list of students that have tags
        
        //get a list of available tags
        
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
