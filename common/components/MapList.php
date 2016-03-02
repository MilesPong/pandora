<?php
namespace common\components;

use yii\base\Component;
use dektrium\user\models\User;
use yii\helpers\ArrayHelper;
use common\models\TeamInfo;
use common\models\UserInfo;

class MapList extends Component
{

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
     * Get relative table data TeamInfo
     *
     * @param bool $onlyActive whether to show active status or not
     * @param bool $unDefinedTeam whether to add undefined team selection
     * @return array the array of TeamInfo
     */
    public function getTeamInfoList($onlyActive = true, $unDefinedTeam = true) {
        if ($onlyActive) {
            $where = ['status' => (string) \Yii::$app->params['active']];
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
     * @param string $onlyAcitve
     * @return array
     */
    public function getUserInfoList($onlyAcitve = true) {
        if ($onlyAcitve) {
            $where = ['status' => (string) \Yii::$app->params['active']];
            $models = UserInfo::find()->where($where)->asArray()->all();
        } else {
            $models = UserInfo::find()->asArray()->all();
        }
        
        return ArrayHelper::map($models, 'uid', 'truename');
    }
}