<?php

namespace backend\controllers;

use Yii;
use common\models\AreaInfo;
use common\models\search\AreaInfoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\core\back\BackController;
use yii\helpers\ArrayHelper;

/**
 * AreaInfoController implements the CRUD actions for AreaInfo model.
 */
class AreaInfoController extends BackController
{
    /**
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'POST'
                    ]
                ]
            ]
        ]);
    }

    /**
     * Lists all AreaInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new AreaInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all AreaInfo models with trash status.
     * @return mixed
     */
    public function actionTrash()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new AreaInfoSearch();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['AreaInfoSearch']['status'] = $searchModel::STATUS_DELETED;
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->pagination->pageSize = 6;
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AreaInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AreaInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AreaInfo();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->area_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AreaInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->area_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AreaInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Url::previous('actions-redirect'));
    }

    /**
     * Finds the AreaInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AreaInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AreaInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \common\core\back\BackController::getBundleModel()
     */
    protected function getBundleModel() {
        return \Yii::createObject(AreaInfo::className());
    }
}
