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
    public $email;
    public $apellido;
    public $nombre;
    public $password;
    public $poblacion;
    public $provincia;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre','email','poblacion','provincia','password'], 'required'],
            [[ 'nombre','password','nick','email','poblacion','provincia'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Email',
            'password' => 'Contraseña',
            'poblacion' => 'Población',
            'provincia' => 'provincia'
        ];
    }

    public function beforeRegister($my_email)
    {
        return null;
    }
}
