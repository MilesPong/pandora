<?php
namespace common\core;

class BaseModel extends \yii\db\ActiveRecord
{
	/**
	 * @return bool Whether the status is blocked or not.
	 */
	public function getIsBlocked()
	{
		return $this->status == \Yii::$app->params['inactive'];
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
}
