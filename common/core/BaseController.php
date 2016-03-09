<?php
namespace common\core;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\MethodNotAllowedHttpException;
use common\components\MapList;
use yii\filters\VerbFilter;
use yii\base\InvalidConfigException;

/**
 * @author miles
 * 
 */
abstract class BaseController extends Controller
{
    /**
     * {@inheritDoc}
     * @see \yii\base\Component::behaviors()
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'bulk' => ['POST'],
                    'block' => ['POST'],
                    'revert' => ['POST']
                ]
            ]
        ];
    }
    
    /**
     * Finds the specify model based on its primary key value
     * @param integer $id
     * @return BaseModel the loaded model
     */
    abstract protected function findModel($id);

    /**
     * Blocks the info.
     *
     * @param integer $id            
     * @return Response
     */
    public function actionBlock($id)
    {
        $model = $this->findModel($id);
        if ($model->getIsBlocked()) {
            $model->unblock();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Info has been unblocked'));
        } else {
            $model->block();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Info has been blocked'));
        }
        
        return $this->redirect(Url::previous('actions-redirect'));
    }

    /**
     * Revert the info.
     *
     * @param integer $id            
     * @return Response
     */
    public function actionRevert($id)
    {
        $model = $this->findModel($id);
        if ($model->getIsDeleted()) {
            $model->revert();
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Info has been revert'));
        }
        
        return $this->redirect(Url::previous('actions-redirect'));
    }
    
    /**
     * Finds the bundle model instance of subclass
     * e.g., the bundle model of `UserInfoController` is `UserInfo`
     * @return BaseModel
     */
    abstract protected function getBundleModel();
    
    /**
     * Bulk actions, include `block`, `unblock`, `delete`
     * 
     * @throws MethodNotAllowedHttpException
     * @return \yii\web\Response
     * @throws InvalidConfigException if there is no primary key difined
     */
    public function actionBulk()
    {
        $bundleModel = $this->getBundleModel();
        $primaryKey = $bundleModel::primaryKey();
        if (isset($primaryKey[0])) {
            $pk = $primaryKey[0];
        } else {
            throw new InvalidConfigException('"' . $bundleModel::className() . '" must have a primary key.');
        }
        $action = Yii::$app->request->post('grid-bulk-actions');
        $map = [
            MapList::ACTION_BLOCK => $bundleModel::STATUS_INACTIVE,
            MapList::ACTION_UNBLOCK => $bundleModel::STATUS_ACTIVE,
            MapList::ACTION_DELETE => $bundleModel::STATUS_DELETED,
        ];
        $info = [
            MapList::ACTION_BLOCK => Yii::t('app', 'Info has been blocked'),
            MapList::ACTION_UNBLOCK => Yii::t('app', 'Info has been unblocked'),
            MapList::ACTION_DELETE => Yii::t('app', 'Info has been deleted'),
        ];
        if ($action && array_key_exists($action, $map)) {
            $res = $bundleModel::updateAll(['status' => $map[$action]], [$pk => Yii::$app->request->post('selection')]);
            if ($res) {
                Yii::$app->getSession()->setFlash('success', $info[$action]);
            }
        }
        return $this->redirect(Url::previous('actions-redirect'));
    }
    
}