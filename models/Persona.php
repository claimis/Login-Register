<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property integer $ID
 * @property string $LastName
 * @property string $FirstName
 * @property integer $Age
 */
class Personas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LastName'], 'required'],
            [['Age'], 'integer'],
            [['LastName', 'FirstName'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'LastName' => 'Last Name',
            'FirstName' => 'First Name',
            'Age' => 'Age',
        ];
    }
}
