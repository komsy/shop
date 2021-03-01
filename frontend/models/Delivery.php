<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $deliveryId
 * @property string $deliveryDesc
 * @property int $cost
 *
 * @property Deposit[] $deposits
 * @property Orderitems[] $orderitems
 * @property Payments[] $payments
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deliveryDesc', 'cost'], 'required'],
            [['cost'], 'integer'],
            [['deliveryDesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'deliveryId' => 'Delivery ID',
            'deliveryDesc' => 'Delivery Desc',
            'cost' => 'Cost',
        ];
    }

    /**
     * Gets query for [[Deposits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeposits()
    {
        return $this->hasMany(Deposit::className(), ['deliveryId' => 'deliveryId']);
    }

    /**
     * Gets query for [[Orderitems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderitems()
    {
        return $this->hasMany(Orderitems::className(), ['deliveryId' => 'deliveryId']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['deliveryId' => 'deliveryId']);
    }
}
