<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "paymentmethods".
 *
 * @property int $paymentMethodId
 * @property string $paymentMethodDesc
 *
 * @property Payments[] $payments
 */
class Paymentmethods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paymentmethods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paymentMethodDesc'], 'required'],
            [['paymentMethodDesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'paymentMethodId' => 'Payment Method ID',
            'paymentMethodDesc' => 'Payment Method Desc',
        ];
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['paymentMethodId' => 'paymentMethodId']);
    }
}
