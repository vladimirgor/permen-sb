<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 25.05.2017
 * Time: 10:14
 */

namespace app\models;


use yii\base\Model;

class IncomeArticleStopForm extends Model{

    public $stop_date;
    public $verifyCode;

    public function rules()
    {
        return [
            [['stop_date'], 'required'],
            [['stop_date'], 'date','format' => 'php:Y-m-d'],
            ['stop_date','compare','compareValue' => date('Y-m-d'), 'operator' => '>=', 'type' => 'date',
            'message' => 'Дата закрытия статьи дохода не может быть меньше текущей даты.'],
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
            'stop_date'  => 'Дата закрытия статьи дохода',
        ];
    }

}