<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $email
 * @property int $inn
 * @property string $company
 */
class Users extends \yii\db\ActiveRecord
{

    public $user_type;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['name', 'surname', 'patronymic', 'email'],
                'required'
            ],
            [
                ['user_type'],
                'integer'
            ],
            [
                ['inn'],
                'integer'
            ],
            [
                ['name', 'surname', 'patronymic', 'email', 'company'],
                'string',
                'max' => 255
            ],
            [
                ['company', 'inn'],
                'default',
                'value' => null,
            ],
            [
                ['email'],
                'email',
            ],
            [
                ['company', 'inn'],
                'required',
                'when' => function($model){
                    return $model->user_type == 1;
                },
                'whenClient' => 'function(attribute, value){
                    return $(\'.js-user-type [type="radio"]:checked\').val() == "1";
                }',
            ],
            [
                ['inn'],
                'string',
                'length' => 12,
                'when' => function($model){
                    return $model->user_type == 0;
                },
                'whenClient' => 'function(attribute, value){
                    return $(\'.js-user-type [type="radio"]:checked\').val() == "0";
                }',
            ],
            [
                ['inn'],
                'string',
                'length' => 10,
                'when' => function($model){
                    return $model->user_type == 1;
                },
                'whenClient' => 'function(attribute, value){
                    return $(\'.js-user-type [type="radio"]:checked\').val() == "1";
                }',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'E-mail',
            'inn' => 'Инн',
            'company' => 'Название организации',
        ];
    }
}
