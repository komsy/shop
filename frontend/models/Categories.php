<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $categoryId
 * @property string $categoryDesc
 *
 * @property Productcategory[] $productcategories
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryDesc'], 'required'],
            [['categoryDesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoryId' => 'Category ID',
            'categoryDesc' => 'Category Desc',
        ];
    }

    /**
     * Gets query for [[Productcategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductcategories()
    {
        return $this->hasMany(Productcategory::className(), ['categoryId' => 'categoryId']);
    }
}
