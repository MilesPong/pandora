<?php
namespace common\core;

use yii\helpers\ArrayHelper;

class BaseModel extends \yii\db\ActiveRecord
{
    /**
     * @return bool Whether the status is deleted or not.
     */
    public function getIsDeleted()
    {
        return $this->status == \Yii::$app->params['deleted'];
    }
    
    /**
     * @return bool Whether the status is blocked or not.
     */
    public function getIsBlocked()
    {
        return $this->status == \Yii::$app->params['inactive'];
    }
    
    /**
     * Revert the info by setting 'status' field.
     */
    public function revert()
    {
        return (bool) $this->updateAttributes(['status' => \Yii::$app->params['active']]);
    }
    
    /**
     * Blocks the info by setting 'status' field.
     */
    public function block()
    {
        return (bool) $this->updateAttributes(['status' => \Yii::$app->params['inactive']]);
    }
    
    /**
     * UnBlocks the info by setting 'status' field.
     */
    public function unblock()
    {
        return (bool) $this->updateAttributes(['status' => \Yii::$app->params['active']]);
    }
    
    /**
     * Soft delete data with ablity to recover
     */
    public function softDelete()
    {
        return (bool) $this->updateAttributes(['status' => \Yii::$app->params['deleted']]);
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::beforeDelete()
     */
    public function beforeDelete()
    {
        if($this->status == \Yii::$app->params['deleted'])
            return true;
        
        $this->softDelete();
        return false;        
    }
    
    /**
     * @param bool $showDeleted define whether to show all status or only delete status
     * @return array array of status
     */
    public function getAllStatus($showDeleted = false) {
        $status = [
            \Yii::$app->params['active'] => \Yii::t('app', 'Active'),
            \Yii::$app->params['inactive'] => \Yii::t('app', 'Inactive'),
        ];
        
        if ($showDeleted) {
            $delete = [\Yii::$app->params['deleted'] => \Yii::t('app', 'Deleted')];
//             $status = ArrayHelper::merge($status, $delete);
            return $delete;
        }
        
        return $status;
    }
    
    /**
     * TODO not work yet
     * This function is used to get map array of the $model
     * 
     * ```php
     * [
     *     '1' => 'data1',
     *     '2' => 'data2',
     *     '3' => 'data3',
     *       ...
     * ]
     * ```
     * 
     * @param Instance $model
     * @param string $key
     * @param string $value
     * @param array $addArray additional array data
     * @return array map array of class
     * @throws InvalidParamException
     */
    public function getMapList($model, $key, $value, $addArray = null) {
        $queryResult = $model->find()->asArray()->all();
        $map = ArrayHelper::map($queryResult, $key, $value);
        if ($addArray && is_array($addArray)) {
            $map = array_merge($map, $addArray);
        } else {
            throw new InvalidParamException('Only array is allowed for addArray.');
        }
        return $map;
    }
}
