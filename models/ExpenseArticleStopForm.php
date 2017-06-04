<?php
namespace app\models;

use yii\base\Model;
class ExpenseArticleStopForm  extends Model{
    public $stop_date;
    public $verifyCode;

    public function rules()
    {
        return [
            [['stop_date'], 'required'],
            [['stop_date'], 'date','format' => 'php:Y-m-d'],
            ['stop_date','compare','compareValue' => date('Y-m-d'), 'operator' => '>=', 'type' => 'date',
                'message' => 'Дата закрытия статьи расхода не может быть меньше текущей даты.'],
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
            'stop_date'  => 'Дата закрытия статьи расхода',
        ];
    }
}