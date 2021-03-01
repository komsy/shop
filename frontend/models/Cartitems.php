<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cartitems".
 *
 * @property int $cartItemsId
 * @property int $cartId
 * @property int $productId
 * @property int $quantity
 *
 * @property Productcart $cart
 * @property Product $product
 */
class Cartitems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cartitems';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cartId', 'productId', 'quantity'], 'required'],
            [['cartId', 'productId', 'quantity'], 'integer'],
            [['cartId'], 'exist', 'skipOnError' => true, 'targetClass' => Productcart::className(), 'targetAttribute' => ['cartId' => 'cartId']],
            [['productId'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['productId' => 'productId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cartItemsId' => 'Cart Items ID',
            'cartId' => 'Cart ID',
            'productId' => 'Product ID',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Cart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Productcart::className(), ['cartId' => 'cartId']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['productId' => 'productId']);
    }
    public function getViews()
    {
        return $this->hasMany(Productcart::className(), ['cartId' => 'cartId']);
    }
     public function getProductimages()
    {
        return $this->hasMany(Productimages::className(), ['productId' => 'productId']);
    }
}
