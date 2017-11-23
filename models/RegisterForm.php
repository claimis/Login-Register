<?php

namespace app\models;
use app\models\Usuario;
use yii\base\Model;
use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property integer $ID
 * @property string $LastName
 * @property string $FirstName
 * @property integer $Age
 */
class RegisterForm extends Model
{
    public $nick;
    public $email;
    public $apellido;
    public $nombre;
    public $pass;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nick'], 'required'],
            [['apellido', 'nombre','pass','nick','email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nick' => 'Nick',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'pass' => 'Contraseña'
        ];
    }

    public function beforeRegister($my_email)
    {
        return null;
    }
}
