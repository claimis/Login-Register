<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $password
 * @property string $email
 * @property string $poblacion
 * @property string $provincia
 * @property string $token
 * @property string $activacion
 * @property string $created_at
 * @property string $rol
 *
 * @property Roles $rol0
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['nombre', 'password', 'passwordConfirm'], 'required'],
            [['email'], 'required'],
            [['created_at'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 60],
            [['email', 'poblacion', 'provincia'], 'string', 'max' => 255],
            [['token', 'activacion'], 'string', 'max' => 32],
            [['rol'], 'string', 'max' => 30],
            [['nombre'], 'unique'],
            [['passwordConfirm'], 'confirmarPassword'],
            [['rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol' => 'rol']],
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
            'password' => 'Password',
            'email' => 'Email',
            'poblacion' => 'Poblacion',
            'provincia' => 'Provincia',
            'token' => 'Token',
            'activacion' => 'Activacion',
            'created_at' => 'Created At',
            'rol' => 'Rol',
        ];
    }



    /**
     * [findIdentity description]
     * @param  [type]  $id [description]
     * @return {[type]     [description]
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * [findIdentityByAccessToken description]
     * @param  [type]  $token [description]
     * @param  [type]  $type  [description]
     * @return {[type]        [description]
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
    /**
     * Busca un usuario por su nombre.
     *
     * @param string $nombre
     * @return static|null
     */
    public static function buscarPorNombre($nombre)
    {
        return static::findOne(['nombre' => $nombre]);
    }
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->token;
    }
    /**
     * [validateAuthKey description]
     * @param  [type]  $authKey [description]
     * @return {[type]          [description]
     */
    public function validateAuthKey($authKey)
    {
        return $this->token === $authKey;
    }
    /**
     * Validar contraseña.
     *
     * @param string $password contraseña a validar
     * @return bool si la contraseña es válida para el usuario actual
     */
    public function validarPassword($password)
    {
        //return Yii::$app->security->validatePassword($password, $this->password);
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    /**
     * [confirmarPassword description]
     * @param  [type]  $attribute [description]
     * @param  [type]  $params    [description]
     * @return {[type]            [description]
     */
    public function confirmarPassword($attribute, $params)
    {
        if ($this->password !== $this->passwordConfirm) {
            $this->addError($attribute, 'Las contraseñas no coinciden');
        }
    }

    /**
    * Comprueba si el usuario es administrador.
    * @return bool si el usuario es administrador
    */
    public function esAdmin()
    {
        // var_dump($this->rol);die();
        return $this->rol === 'Admin';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
            $this->token = Yii::$app->security->generateRandomString();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol()
    {
        return $this->hasOne(Roles::className(), ['rol' => 'rol'])->inverseOf('usuarios');
    }
}