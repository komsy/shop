<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $paymentId
 * @property int $orderId
 * @property int $amount
 * @property int $phoneCode
 * @property int $mpesaNumber
 * @property int $userId
 * @property int $paymentMethodId
 * @property int $deliveryId
 * @property string $status
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property Orders $order
 * @property Paymentmethods $paymentMethod
 * @property User $user
 * @property User $createdBy0
 * @property Delivery $delivery
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderId', 'amount', 'phoneCode', 'mpesaNumber', 'userId', 'paymentMethodId', 'deliveryId', 'createdBy'], 'required'],
            [['orderId', 'amount', 'phoneCode', 'mpesaNumber', 'userId', 'paymentMethodId', 'deliveryId', 'createdBy'], 'integer'],
            [['createdAt'], 'safe'],
            [['status'], 'string', 'max' => 100],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orderId' => 'orderId']],
            [['paymentMethodId'], 'exist', 'skipOnError' => true, 'targetClass' => Paymentmethods::className(), 'targetAttribute' => ['paymentMethodId' => 'paymentMethodId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['deliveryId'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['deliveryId' => 'deliveryId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paymentId' => 'Payment ID',
            'orderId' => 'Order ID',
            'amount' => 'Amount',
            'phoneCode' => 'Phone Code',
            'mpesaNumber' => 'Mpesa Number',
            'userId' => 'User ID',
            'paymentMethodId' => 'Payment Method ID',
            'deliveryId' => 'Delivery ID',
            'status' => 'Status',
            'createdAt' => 'Created At',
            'createdBy' => 'Created By',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['orderId' => 'orderId']);
    }

    /**
     * Gets query for [[PaymentMethod]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(Paymentmethods::className(), ['paymentMethodId' => 'paymentMethodId']);
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
     * Gets query for [[CreatedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * Gets query for [[Delivery]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['deliveryId' => 'deliveryId']);
    }
}
