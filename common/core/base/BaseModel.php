<?php
namespace common\core\base;

use yii\helpers\ArrayHelper;

/**
 * BaseModel is the base class of both backend and frontend models.
 * 
 * @author miles
 */
class BaseModel extends \yii\db\ActiveRecord
{

    /**
     *
     * @var integer status active
     */
    const STATUS_ACTIVE = 1;

    /**
     * @var integer status inactive
     */
    const STATUS_INACTIVE = 2;

    /**
     * @var integer status deleted
     */
    const STATUS_DELETED = 3;
    

    /**
     * Return the array of status
     * @param string $includeDeleted
     * @return array
     */
    public function getStatusArray($includeDeleted = false) {
        $statusArray = [
            self::STATUS_ACTIVE,
            self::STATUS_INACTIVE,
        ];
        
        if ($includeDeleted) {
            $statusArray = array_merge($statusArray, [self::STATUS_DELETED]);
        }
        
        return $statusArray;
    }
    
    /**
     * @return bool Whether the status is deleted or not.
     */
    public function getIsDeleted()
    {
        return $this->status == self::STATUS_DELETED;
    }
    
    /**
     * @return bool Whether the status is blocked or not.
     */
    public function getIsBlocked()
    {
        return $this->status == self::STATUS_INACTIVE;
    }
    
    /**
     * Revert the info by setting 'status' field.
     */
    public function revert()
    {
        return (bool) $this->updateAttributes(['status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Blocks the info by setting 'status' field.
     */
    public function block()
    {
        return (bool) $this->updateAttributes(['status' => self::STATUS_INACTIVE]);
    }
    
    /**
     * UnBlocks the info by setting 'status' field.
     */
    public function unblock()
    {
        return (bool) $this->updateAttributes(['status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Soft delete data with ablity to recover
     */
    public function softDelete()
    {
        return (bool) $this->updateAttributes(['status' => self::STATUS_DELETED]);
    }
    
    /**
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::beforeDelete()
     */
    public function beforeDelete()
    {
        if($this->status == self::STATUS_DELETED)
            return true;
        
        $this->softDelete();
        return false;        
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
