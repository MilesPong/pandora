<?php
namespace common\core;

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
	
	public function beforeDelete()
	{
		if($this->status == \Yii::$app->params['deleted'])
			return true;
		
		$this->softDelete();
		return false;		
	}
}
