<?php
namespace common\components;

use yii\base\Component;
use dektrium\user\models\User;
use yii\helpers\ArrayHelper;
use common\models\TeamInfo;
use common\models\UserInfo;
use common\core\base\BaseModel;
use common\models\PositionInfo;
use common\models\AreaInfo;

/**
 * MapList is used to return map data of model for dropdownlist
 * 
 * @author miles
 *
 */
class MapList extends Component
{

    /**
     * @var integer bulk action `block`
     */
    const ACTION_BLOCK = 2;

    /**
     * @var integer bulk action `unblock`
     */
    const ACTION_UNBLOCK = 1;

    /**
     * @var integer bulk action `delete`
     */
    const ACTION_DELETE = 3;

    /**
     * Get map data of User
     * 
     * @return array
     */
    public function getUserList()
    {
        $models = User::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'username');
    }
    
    /**
     * Get map data of PositionInfo
     * 
     * @return array
     */
    public function getPositionList()
    {
        $model = PositionInfo::find()->asArray()->all();
        return ArrayHelper::map($model, 'position_id', 'position_name');
    }
    
    /**
     * Get map data of AreaInfo
     *
     * @return array
     */
    public function getAreaList($onlyActive = true)
    {
        if ($onlyActive) {
            $where = ['status' => BaseModel::STATUS_ACTIVE];
            $models = AreaInfo::find()->where($where)->asArray()->all();
        } else {
            $models = AreaInfo::find()->asArray()->all();
        }
        
        return ArrayHelper::map($models, 'area_id', 'area_name');
    }
    
    /**
     * Get relative table data TeamInfo
     *
     * @param bool $onlyActive whether to show active status or not
     * @param bool $unDefinedTeam whether to add undefined team selection
     * @return array the array of TeamInfo
     */
    public function getTeamInfoList($onlyActive = true, $unDefinedTeam = true)
    {
        if ($onlyActive) {
            $where = ['status' => BaseModel::STATUS_ACTIVE];
            $models = TeamInfo::find()->where($where)->asArray()->all();
        } else {
            $models = TeamInfo::find()->asArray()->all();
        }
    
        $map = ArrayHelper::map($models, 'team_id', 'team_name');
        
        if ($unDefinedTeam) {
            $map = ['0' => \Yii::t('app', 'UnDefined Team')] + $map;
        }
        
        return $map;
    }
    

    /**
     * Get map data of UserInfo
     * @param string $onlyActive
     * @return array
     */
    public function getUserInfoList($onlyActive = true)
    {
        if ($onlyActive) {
            $where = ['status' => BaseModel::STATUS_ACTIVE];
            $models = UserInfo::find()->where($where)->asArray()->all();
        } else {
            $models = UserInfo::find()->asArray()->all();
        }
        
        return ArrayHelper::map($models, 'uid', 'truename');
    }
    
    /**
     * Get the bulk actions array for dropdownlist
     * @return string[]
     */
    public function getBulkActionsList()
    {
        return [
            self::ACTION_BLOCK => \Yii::t('app', 'Block'),
            self::ACTION_UNBLOCK =>\Yii::t('app', 'Unblock'),
            self::ACTION_DELETE => \Yii::t('app', 'Delete'),
        ];
    }
    
    /**
     * @param bool $showDeleted define whether to show all status included deleted
     * @return array array of status
     */
    public function getStatusList($showDeleted = false) {
        $status = [
            BaseModel::STATUS_ACTIVE => \Yii::t('app', 'Active'),
            BaseModel::STATUS_INACTIVE => \Yii::t('app', 'Inactive'),
        ];
    
        if ($showDeleted) {
            //             $delete = [self::STATUS_DELETED => \Yii::t('app', 'Deleted')];
            //             $status = ArrayHelper::merge($status, $delete);
            //             return $delete;
            $status = $status + [BaseModel::STATUS_DELETED => \Yii::t('app', 'Deleted')];
        }
    
        return $status;
    }
}