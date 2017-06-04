<?php
namespace app\models;

use Yii;
use yii\base\Model;
class RegisterForm  extends Model {
    public $firstname;
    public $lastname;
    public $login;
    public $password;
    public $password_repeat;
    public $verifyCode;

    public function rules()
    {
        return [
            [['firstname','lastname','login', 'password','password_repeat'], 'required'],
            [['firstname','lastname','login'],'string','length'=> [2,256]],
            ['password','string','length'=> [2,32]],
            ['password','compare'],
            //['password','compare','message' => 'Password and Password Repeat are to be same.'],
            ['login','unique','targetClass' => User::className()],
            //['login','unique','targetClass' => 'app\models\Users'], // same with previous
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'
                , 'captchaAction' => 'budget/captcha'
            ],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Код верификации',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'login'    => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль'
        ];
    }
}