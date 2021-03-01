<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $productId
 * @property string $productName
 * @property string $productDesc
 * @property float $basePrice
 * @property int $uomId
 * @property int $brandId
 * @property int $colorId
 * @property string $created_at
 * @property string $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Cartitems[] $cartitems
 * @property Orderitems[] $orderitems
 * @property Productbrand $brand
 * @property Productcolor $color
 * @property Productuom $uom
 * @property Productcategory[] $productcategories
 * @property Productimages[] $productimages
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['productName', 'productDesc', 'basePrice', 'uomId', 'brandId', 'colorId', 'created_by', 'updated_by'], 'required'],
            [['productDesc'], 'string'],
            [['basePrice'], 'number'],
            [['uomId', 'brandId', 'colorId', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['productName'], 'string', 'max' => 255],
            [['brandId'], 'exist', 'skipOnError' => true, 'targetClass' => Productbrand::className(), 'targetAttribute' => ['brandId' => 'brandId']],
            [['colorId'], 'exist', 'skipOnError' => true, 'targetClass' => Productcolor::className(), 'targetAttribute' => ['colorId' => 'colorId']],
            [['uomId'], 'exist', 'skipOnError' => true, 'targetClass' => Productuom::className(), 'targetAttribute' => ['uomId' => 'uomId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'productId' => 'Product ID',
            'productName' => 'Product Name',
            'productDesc' => 'Product Desc',
            'basePrice' => 'Base Price',
            'uomId' => 'Uom ID',
            'brandId' => 'Brand ID',
            'colorId' => 'Color ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Cartitems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCartitems()
    {
        return $this->hasMany(Cartitems::className(), ['productId' => 'productId']);
    }

    /**
     * Gets query for [[Orderitems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderitems()
    {
        return $this->hasMany(Orderitems::className(), ['productId' => 'productId']);
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Productbrand::className(), ['brandId' => 'brandId']);
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Productcolor::className(), ['colorId' => 'colorId']);
    }

    /**
     * Gets query for [[Uom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUom()
    {
        return $this->hasOne(Productuom::className(), ['uomId' => 'uomId']);
    }

    /**
     * Gets query for [[Productcategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductcategories()
    {
        return $this->hasMany(Productcategory::className(), ['productId' => 'productId']);
    }

    /**
     * Gets query for [[Productimages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductimages()
    {
        return $this->hasMany(Productimages::className(), ['productId' => 'productId']);
    }
}
