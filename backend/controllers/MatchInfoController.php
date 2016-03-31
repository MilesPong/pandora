<?php

namespace backend\controllers;

use Yii;
use common\models\MatchInfo;
use common\models\search\MatchInfoSearch;
use common\core\back\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * MatchInfoController implements the CRUD actions for MatchInfo model.
 */
class MatchInfoController extends BackController
{
    /**
     * @inheritdoc
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
     * Lists all MatchInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new MatchInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 6;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all deleted MatchInfo models.
     * @return mixed
     */
    public function actionTrash()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new MatchInfoSearch();
        $queryParams = \Yii::$app->request->getQueryParams();
        $queryParams['MatchInfoSearch']['status'] = $searchModel::STATUS_DELETED;
        $dataProvider = $searchModel->search($queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single MatchInfo model.
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
     * Creates a new MatchInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MatchInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->match_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MatchInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->match_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MatchInfo model.
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
     * Finds the MatchInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MatchInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatchInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * {@inheritDoc}
     * @see \common\core\back\BackController::getBundleModel()
     */
    protected function getBundleModel()
    {
        return \Yii::createObject(MatchInfo::className());
    }
}
