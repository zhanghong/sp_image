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
        ];
    }
}