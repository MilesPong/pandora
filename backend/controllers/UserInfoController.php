<?php

namespace backend\controllers;

use Yii;
use common\models\UserInfo;
use common\models\search\UserInfoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use common\core\BaseController;
use yii\base\Object;
use yii\web\UploadedFile;

/**
 * UserInfoController implements the CRUD actions for UserInfo model.
 */
class UserInfoController extends BaseController
{
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
     * Lists all UserInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
    	Url::remember('', 'actions-redirect');
        $searchModel = new UserInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=6;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
    	$searchModel->status = Yii::$app->params['deleted'];
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	$dataProvider->pagination->pageSize=6;
    
    	return $this->render('index', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
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
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserInfo();

        if ($model->load(Yii::$app->request->post())) {
        	list($image,$path) = $this->saveImage($model);
        	if ($model->save()){
        		$image->saveAs($path);
        		return $this->redirect(['view', 'id' => $model->uid]);
        	}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

        if ($model->load(Yii::$app->request->post())) {
        	list($image,$path) = $this->saveImage($model);
        	if ($model->save()){
        		$image->saveAs($path);
	            return $this->redirect(['view', 'id' => $model->uid]);
        	}
        } else {
        	if ($model->status == \Yii::$app->params['deleted'])
        		return $this->redirect(Url::previous('actions-redirect'));
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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

        return $this->redirect(['index']);
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
    
    	return $this->render('upload', ['model' => $model]);
    }
    
    /**
     * To save user profile image
     * @param UserInfo $model
     * @return boolean
     */
    protected function saveImage($model)
    {
    		$pathFolder = Yii::getAlias('@avatar');
    		if ( !is_dir($pathFolder) && !mkdir($pathFolder, 0775)){
    			throw new \Exception('Could not create directory.');
    		}
    		
    	    $image = UploadedFile::getInstance($model, 'image');
        	$ext = end((explode(".", $image->name)));
        	 
        	// generate a unique file name
        	$model->avatar = Yii::$app->security->generateRandomString().".{$ext}";
        	
        	// the path to save file
        	$path = $pathFolder . DIRECTORY_SEPARATOR . $model->avatar;
        	
        	return [$image, $path];
    }

}
