<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $orderId
 * @property int $userId
 * @property float $total
 * @property int $orderStatus
 * @property int $deliveryId
 * @property string $createdAt
 * @property int $createBy
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'total', 'deliveryId', 'createBy'], 'required'],
            [['userId', 'orderStatus', 'deliveryId', 'createBy'], 'integer'],
            [['total'], 'number'],
            [['createdAt'], 'safe'],
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
            'deliveryId' => 'Delivery ID',
            'createdAt' => 'Created At',
            'createBy' => 'Create By',
        ];
    }
}
