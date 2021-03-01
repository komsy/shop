<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $orderId
 * @property int $userId
 * @property int $total
 * @property string $orderStatus
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property Deposit[] $deposits
 * @property MpesaStkRequests[] $mpesaStkRequests
 * @property Orderitems[] $orderitems
 * @property User $user
 * @property Payments[] $payments
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'total', 'createdBy'], 'required'],
            [['userId', 'total', 'createdBy'], 'integer'],
            [['createdAt'], 'safe'],
            [['orderStatus'], 'string', 'max' => 200],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'orderId' => 'Order ID',
            'userId' => 'User ID',
            'total' => 'Total',
            'orderStatus' => 'Order Status',
            'createdAt' => 'Created At',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Deposits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeposits()
    {
        return $this->hasMany(Deposit::className(), ['orderId' => 'orderId']);
    }

    /**
     * Gets query for [[MpesaStkRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMpesaStkRequests()
    {
        return $this->hasMany(MpesaStkRequests::className(), ['orderId' => 'orderId']);
    }

    /**
     * Gets query for [[Orderitems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderitems()
    {
        return $this->hasMany(Orderitems::className(), ['orderId' => 'orderId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['orderId' => 'orderId']);
    }
}
