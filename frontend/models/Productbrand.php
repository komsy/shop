<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "productbrand".
 *
 * @property int $brandId
 * @property string $brandName
 *
 * @property Product[] $products
 */
class Productbrand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productbrand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brandName'], 'required'],
            [['brandName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'brandId' => 'Brand ID',
            'brandName' => 'Brand Name',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['brandId' => 'brandId']);
    }
}
