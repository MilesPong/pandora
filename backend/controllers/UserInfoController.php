<?php

namespace backend\controllers;

use Yii;
use common\models\UserInfo;
use common\models\search\UserInfoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use common\core\UploadException;
use yii\helpers\ArrayHelper;
use common\core\back\BackController;

/**
 * UserInfoController implements the CRUD actions for UserInfo model.
 */
class UserInfoController extends BackController
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
     * Lists all UserInfo models.
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new UserInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 6;
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    
    /**
     * TODO This funciton should be combined with index function 
     * Lists all Deleted UserInfo models.
     * @return mixed
     */
    public function actionTrash()
    {
        Url::remember('', 'actions-redirect');
        $searchModel = new UserInfoSearch();
        // Yii2 default values for Index data Provider, via: http://www.yiiframework.com/wiki/663/yii2-default-values-for-index-data-provider/
        $queryParams = array_merge(array(), \Yii::$app->request->getQueryParams());
        $queryParams['UserInfoSearch']['status'] = $searchModel::STATUS_DELETED;
        $dataProvider = $searchModel->search($queryParams);
        $dataProvider->pagination->pageSize = 6;
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single UserInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }
    
    /**
     * Creates a new UserInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserInfo();
        
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        try {
            if ($model->load(Yii::$app->request->post())) {
                // process uploaded image file instance
                $image = $model->uploadImage();
                
                if ($model->save()) {
                    // upload only if valid uploaded file instance found
                    if ($image !== false) {
                        if ($image->error == UPLOAD_ERR_OK) {
                            $path = $model->getImageFile();
                            $image->saveAs($path);
                        } else {
                            throw new UploadException($image->error);
                        }
                    }
                    
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->uid]);
                }
            }
        } catch (UploadException $e) {
            $transaction->rollBack();
            $uploadMsg = $e->getMessage();
        }
        
        return $this->render('create', [
            'model' => $model,
            'uploadMsg' => isset($uploadMsg) ? $uploadMsg : null
        ]);
    }

    /**
     * Updates an existing UserInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldImageFile = $model->getImageFile();
        $oldAvatar = $model->avatar;
        
        $connection = Yii::$app->db;
        $transaction = $connection->beginTransaction();
        
        try {
            if ($model->load(Yii::$app->request->post())) {
                // process uploaded image file instance
                $image = $model->uploadImage();
                
                if ($model->save()) {
                    // upload only if valid uploaded file instance found
                    if ($image === false) {
                        // revert back if no valid file instance uploaded
                        $model->avatar = $oldAvatar;
                    } else {
                        if ($image->error == UPLOAD_ERR_OK) {
                            $path = $model->getImageFile();
                            $image->saveAs($path);
                            @unlink($oldImageFile); // delete old file
                        } else {
                            throw new UploadException($image->error);
                        }
                    }
                    
                    $transaction->commit();
                    
                    return $this->redirect(['view', 'id' => $model->uid]);
                }
            }
        } catch (UploadException $e) {
            $transaction->rollBack();
            // revert back if no valid file instance uploaded
            $model->avatar = $oldAvatar;
            $uploadMsg = $e->getMessage();
        }
        
        if ($model->status == $model::STATUS_DELETED)
            return $this->redirect(Url::previous('actions-redirect'));
        return $this->render('update', [
            'model' => $model,
            'uploadMsg' => isset($uploadMsg) ? $uploadMsg : null
        ]);
    }

    /**
     * Deletes an existing UserInfo model.
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
     * Finds the UserInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * @return \yii\web\Response|string
     */
    public function actionUpload()
    {
        $model = new \common\models\UploadForm();
        
        if (Yii::$app->request->isPost) {
            $model->imageFile = \yii\web\UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                Yii::$app->session->setFlash('uploadSubmitted');
                return $this->refresh();
            }
        }
        
        return $this->render('upload', [
            'model' => $model
        ]);
    }
    
    /**
     * {@inheritDoc}
     * @see \common\core\back\BackController::getBundleModel()
     */
    protected function getBundleModel()
    {
        return Yii::createObject(UserInfo::className());
    }
    
}
