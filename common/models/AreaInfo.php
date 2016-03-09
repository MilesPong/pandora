<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%area_info}}".
 *
 * @property integer $area_id
 * @property string $area_name
 * @property string $position_lng
 * @property string $position_lat
 * @property string $memo
 * @property string $status
 *
 * @property MatchInfo[] $matchInfos
 */
class AreaInfo extends \common\core\base\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%area_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_name'], 'required'],
            [['memo', 'status'], 'string'],
            [['area_name'], 'string', 'max' => 25],
            [['position_lng', 'position_lat'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => Yii::t('app', 'Area ID'),
            'area_name' => Yii::t('app', 'Area Name'),
            'position_lng' => Yii::t('app', 'Position Lng'),
            'position_lat' => Yii::t('app', 'Position Lat'),
            'memo' => Yii::t('app', 'Memo'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchInfos()
    {
        return $this->hasMany(MatchInfo::className(), ['area_id' => 'area_id']);
    }
}
