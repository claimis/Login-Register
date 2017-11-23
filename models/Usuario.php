<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property string $id
 * @property string $nombre
 * @property string $apellido
 * @property string $nick
 * @property string $email
 * @property string $pass
 * @property string $reg_date
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'nick'], 'required'],
            [['reg_date'], 'safe'],
            [['nombre', 'apellido'], 'string', 'max' => 30],
            [['nick'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50],
            [['pass'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'nick' => 'Nick',
            'email' => 'Email',
            'pass' => 'Pass',
            'reg_date' => 'Reg Date',
        ];
    }
}
