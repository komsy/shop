<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "deposit".
 *
 * @property int $transId
 * @property string|null $MerchantRequestId
 * @property int $orderId
 * @property int $deliveryId
 * @property float $transAmount
 * @property int $phoneCode
 * @property int $mpesaNumber
 * @property string|null $reciept
 * @property string $transDate
 * @property int $createdBy
 * @property int|null $status
 *
 * @property User $createdBy0
 * @property Orders $order
 * @property Delivery $delivery
 */
class Deposit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'deposit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orderId', 'deliveryId', 'transAmount', 'phoneCode', 'mpesaNumber', 'createdBy'], 'required'],
            [['orderId', 'deliveryId', 'phoneCode', 'mpesaNumber', 'createdBy', 'status'], 'integer'],
            [['transAmount'], 'number'],
            [['transDate'], 'safe'],
            [['MerchantRequestId', 'reciept'], 'string', 'max' => 100],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['orderId'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['orderId' => 'orderId']],
            [['deliveryId'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['deliveryId' => 'deliveryId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'transId' => 'Trans ID',
            'MerchantRequestId' => 'Merchant Request ID',
            'orderId' => 'Order ID',
            'deliveryId' => 'Delivery ID',
            'transAmount' => 'Trans Amount',
            'phoneCode' => 'Phone Code',
            'mpesaNumber' => 'Mpesa Number',
            'reciept' => 'Reciept',
            'transDate' => 'Trans Date',
            'createdBy' => 'Created By',
            'status' => 'Status',
        ];
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
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['orderId' => 'orderId']);
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
