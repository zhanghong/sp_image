<?php

namespace simple\image\models;

use Yii;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\UserProfile;

class ContainerTopoRelated extends ActiveRecord
{
    public static function tableName()
    {
        return 'container_topo_related';
    }

    public function getTopo()
    {
        return $this->hasOne(Topo::className(), ['id'=>'topo_id']);
    }
}