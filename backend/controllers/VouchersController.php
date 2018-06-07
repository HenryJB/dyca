<?php

namespace backend\controllers;

use Yii;
use common\models\Voucher;
use common\models\VoucherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VouchersController implements the CRUD actions for Voucher model.
 */
class VouchersController extends Controller
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

    /**
     * Lists all Voucher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VoucherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Voucher model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Voucher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Voucher();
        $session = Yii::$app->session;


        if ($model->load(Yii::$app->request->post())) {
          $num = Yii::$app->request->post('num');
          $count =1;

          $session->set('prefix', $model->prefix);
          $session->set('description', $model->description);
          $session->set('expiry_date', $model->expiry_date);
          $session->set('discount', $model->discount);


          for ($i = 0; $i < $num; $i++) {

              $model = new Voucher();
              $model->prefix= $session->get('prefix');
              $model->description= $session->get('description');
              $model->expiry_date = $session->get('expiry_date');
              $model->discount = $session->get('discount');

              //$res .= $chars[substr(mt_rand(0, strlen($chars)-1), 0 ,10)];

              $model->status = 'not used';
              $model->code = $this->RandomString();
              if($model->validate() && $model->save()){
                $count ++;
              }
          }
            //print_r($model->getErrors());
            return $this->redirect(['index']);
        }
        print_r($model->getErrors());
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    private function RandomString($length = 10) {
    $randstr='';
    srand((double) microtime(TRUE) * 1000000);
    //our array add all letters and numbers if you wish
    $chars = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'p',
        'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5',
        '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
        'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    for ($rand = 0; $rand <$length; $rand++) {
        $random = rand(0, count($chars) - 1);
        $randstr .= $chars[$random];
    }
    return strtoupper($randstr);
}

    /**
     * Updates an existing Voucher model.
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
     * Deletes an existing Voucher model.
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
     * Finds the Voucher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Voucher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Voucher::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
