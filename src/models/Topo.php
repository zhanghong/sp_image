<?php

namespace simple\image\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\UserProfile;

class Topo extends ActiveRecord
{
    public static function tableName()
    {
        return 'topo';
    }

    public function rules()
    {
        return [

        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), ['id' => 'user_id']);
    }

    /**
     * 拓扑配置信息
     * @Author   zhanghong(Laifuzi)
     * @DateTime 2019-10-30
     * @return   array
     */
    public function getContainerSum()
    {
        $selectFields = [
            'ROUND(SUM(config_ram)/1024) AS ram_sum',
            'ROUND(SUM(config_disk)) AS disk_sum',
            'ROUND(SUM(config_cpu)) AS cpu_sum',
        ];

        $record = ContainerTopoRelated::find()
                    ->select($selectFields)
                    ->where(['topo_id' => $this->id])
                    ->asArray()
                    ->one();

        if (empty($record)) {
            return [
                'ram_sum' => 0,
                'disk_sum' => 0,
                'cpu_sum' => 0,
            ];
        }

        foreach ($record as $key => $value) {
            $record[$key] = intval($value);
        }

        return $record;
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['deleted_at']);

        return $fields;
    }

    public function extraFields()
    {
        return [
            'user',
            'userProfile',
            'container_sum' => function($model){
                return $this->containerSum;
            },
        ];
    }
}