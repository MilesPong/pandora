<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%position_info}}".
 *
 * @property integer $position_id
 * @property string $position_name
 *
 * @property UserTeamInfo[] $userTeamInfos
 */
class PositionInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%position_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_name'], 'required'],
            [['position_name'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => Yii::t('app', 'Position ID'),
            'position_name' => Yii::t('app', 'Position Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTeamInfos()
    {
        return $this->hasMany(UserTeamInfo::className(), ['position_id' => 'position_id']);
    }
}
