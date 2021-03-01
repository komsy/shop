<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "productuom".
 *
 * @property int $uomId
 * @property string $uomDesc
 * @property float $uomPrice
 * @property int $quantity
 *
 * @property Product[] $products
 */
class Productuom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productuom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uomDesc', 'uomPrice', 'quantity'], 'required'],
            [['uomPrice'], 'number'],
            [['quantity'], 'integer'],
            [['uomDesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uomId' => 'Uom ID',
            'uomDesc' => 'Uom Desc',
            'uomPrice' => 'Uom Price',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['uomId' => 'uomId']);
    }
}
