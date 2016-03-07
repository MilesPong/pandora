<?php
namespace common\core;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

/**
 * @author miles
 * 
 */
abstract class BaseController extends Controller
{
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
}