<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 20.05.2017
 * Time: 20:40
 */

namespace app\models;
use yii\base\Model;
use IntlDateFormatter;

class SheetForm  extends Model{
    public $from;
    public $to;
    public $verifyCode;


    public function rules()
    {
        return [
            [['from','to'], 'required'],
            [['from','to'], 'date','format' => 'php:Y-m-d','max' => date('Y-m-d'),'min' => '1000-01-01'],
            ['to','compare','compareAttribute' => 'from','operator' => '>=', 'type' => 'date'],
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
            'from'  => 'Дата с',
            'to'  => 'Дата по',

        ];
    }

}