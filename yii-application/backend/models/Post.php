<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $category
 * @property string $description
 * @property string $image
 * @property string $date
 *
 * @property string CPU
 * @property string MotherBoard
 * @property string ComputerCase
 * @property string VideoCard
 * @property string CoolingSystem
 * @property string RAM
 * @property string ROM
 * @property string PowerSupply
 * @property string AudioCard
 * @property integer Price
 *
 *
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'date'], 'required'],
            [['description'], 'string'],
            [['image'], 'string'],
            [['date'], 'safe'],
            [['title'], 'string', 'max' => 255],

            [['category'],  'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number'],
            [['category'],  'compare', 'compareValue' => 5, 'operator' => '<=', 'type' => 'number'],

            [['CPU', 'MotherBoard', 'ComputerCase', 'VideoCard', 'CoolingSystem', 'RAM', 'ROM', 'PowerSupply', 'AudioCard'], 'string', 'max' => 255],
            [['Price'],
                'number',
                'integerOnly' => true,
                'min' => 1,
                'max' => 99999,
                'tooSmall' => 'You must enter at least 1 piece',
                'tooBig' => 'You cannot enter more than 99999 pieces'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'category' => Yii::t('app', 'Category'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'date' => Yii::t('app', 'Date'),

            'CPU' => Yii::t('app', 'CPU'),
            'MotherBoard' => Yii::t('app', 'MotherBoard'),
            'ComputerCase' => Yii::t('app', 'ComputerCase'),
            'VideoCard' => Yii::t('app', 'VideoCard'),
            'CoolingSystem' => Yii::t('app', 'CoolingSystem'),
            'RAM' => Yii::t('app', 'RAM'),
            'ROM' => Yii::t('app', 'ROM'),
            'PowerSupply' => Yii::t('app', 'PowerSupply'),
            'AudioCard' => Yii::t('app', 'AudioCard'),
            'Price' => Yii::t('app', 'Price')
        ];
    }

}
