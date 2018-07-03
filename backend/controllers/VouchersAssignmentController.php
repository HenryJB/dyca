<?php

namespace backend\controllers;

use Yii;
use common\models\VouchersAssignment;
use common\models\Voucher;
use common\models\VouchersAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VouchersAssignmentController implements the CRUD actions for VouchersAssignment model.
 */
class VouchersAssignmentController extends Controller
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
     * Lists all VouchersAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VouchersAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VouchersAssignment model.
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
     * Creates a new VouchersAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VouchersAssignment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VouchersAssignment model.
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
     * Deletes an existing VouchersAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $voucher = Voucher::findOne((int)$this->findModel((int)$id)->voucher_id);

        switch ($voucher->status) {
            case 'not used':
                $this->findModel((int)$id)->delete();
                Yii::$app->runAction('messaging/revoke-voucher', ['id' => $id]);
                break;
            case 'assigned' :
                $voucher->satus = 'not used';
                if ($voucher->update()) {
                    $this->findModel((int)$id)->delete();
                    Yii::$app->runAction('messaging/revoke-voucher', ['id' => $id]);
                }
                break;
            case 'used' :
                $this->findModel((int)$id)->delete();
                Yii::$app->runAction('messaging/revoke-voucher', ['id' => $id]);
                break;
            default:
                Yii::$app->session->setFlash('error', 'Failed: Voucher Not Revoked');
                break;
        }
        return $this->redirect(['index']);

    }

    /**
     * Finds the VouchersAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VouchersAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VouchersAssignment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
